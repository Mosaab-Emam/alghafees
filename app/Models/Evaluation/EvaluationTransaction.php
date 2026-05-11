<?php

namespace App\Models\Evaluation;

use App\Models\Model;
use App\Models\Category;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transaction_files;
use Illuminate\Validation\ValidationException;
use Str;


/**
 * Transaction `status` integer codes:
 * 0 new, 1 in review (legacy, hidden from some UIs), 2 contacted, 3 reviewed/inspection (legacy),
 * 4 finished (approved), 5 pending, 6 cancelled,
 * 7 under observation, 8 under evaluation, 9 under review (workflow stages).
 */
class EvaluationTransaction extends Model
{

    use HasFactory;

    public const STATUS_NEW = 0;

    public const STATUS_IN_REVIEW_LEGACY = 1;

    public const STATUS_CONTACTED = 2;

    public const STATUS_REVIEWED_LEGACY = 3;

    public const STATUS_FINISHED = 4;

    public const STATUS_PENDING = 5;

    public const STATUS_CANCELLED = 6;

    public const STATUS_UNDER_OBSERVATION = 7;

    public const STATUS_UNDER_EVALUATION = 8;

    public const STATUS_UNDER_REVIEW = 9;

    /** Statuses used for “active workflow” lists and appointment reminders (legacy 3 + new 7–9). */
    public const WORKFLOW_IN_PROGRESS_STATUSES = [3, 7, 8, 9];

    protected $fillable = [
        'evaluation_company_id',
        'evaluation_employee_id',
        'instrument_number',
        'transaction_number',
        'is_iterated',
        'date',
        'owner_name',
        'type_id',
        'region',
        'previewer_id',
        'review_id',
        'approver_id',
        'income_id',
        'city_id',
        'notes',
        'status',
        'review_fundoms',
        'company_fundoms',
        'phone',
        'new_city_id',
        'plan_no',
        'plot_no',
        'preview_date_time',
        'income_date_time',
        'review_date_time',
    ];


    public $timestamps = true;

    /**
     * @return array<string, string> role foreign key => users.id lock column
     */
    public static function roleAssignmentLockMap(): array
    {
        return [
            'previewer_id' => 'previewer_locked_by',
            'income_id' => 'income_locked_by',
            'review_id' => 'review_locked_by',
            'approver_id' => 'approver_locked_by',
        ];
    }

    public static function isRoleAssignmentLockedByOther(?self $record, string $lockColumn): bool
    {
        if (!$record || !$record->exists) {
            return false;
        }
        $by = $record->getAttribute($lockColumn);
        if ($by === null) {
            return false;
        }

        return (int) $by !== (int) auth()->id();
    }

    public static function roleAssignmentLockHint(?self $record, string $lockColumn): ?string
    {
        return static::isRoleAssignmentLockedByOther($record, $lockColumn)
            ? __('admin.evaluation-transactions.role_assignment_locked_hint')
            : null;
    }

    protected static function booted(): void
    {
        static::creating(function (EvaluationTransaction $evaluationTransaction) {
            if (is_numeric($evaluationTransaction->instrument_number) and EvaluationTransaction::where('instrument_number', $evaluationTransaction->instrument_number)->count()) {
                \DB::update('update evaluation_transactions set is_iterated=1 where instrument_number=?', [$evaluationTransaction->instrument_number]);
                $evaluationTransaction->is_iterated = true;
            }
        });
        static::creating(function (EvaluationTransaction $evaluationTransaction) {
            $uid = auth()->id();
            if ($uid === null) {
                return;
            }
            foreach (self::roleAssignmentLockMap() as $role => $lock) {
                if ($evaluationTransaction->getAttribute($role) !== null) {
                    $evaluationTransaction->setAttribute($lock, $uid);
                }
            }
        });
        static::updating(function (EvaluationTransaction $evaluationTransaction) {
            $evaluationTransaction->assertAndApplyRoleAssignmentLocksForUpdate();
        });
        static::updating(function (EvaluationTransaction $evaluationTransaction) {
            if ($evaluationTransaction->isDirty('instrument_number')) {
                $new_trans = EvaluationTransaction::where('instrument_number', $evaluationTransaction->instrument_number)->where('id', '!=', $evaluationTransaction->id)->get();
                $old_trans = EvaluationTransaction::where('instrument_number', $evaluationTransaction->getOriginal('instrument_number'))->where('id', '!=', $evaluationTransaction->id)->get();
                if (is_numeric($evaluationTransaction->instrument_number) and is_numeric($evaluationTransaction->getOriginal('instrument_number'))) {
                    if ($new_trans->count() == 1) {
                        \DB::statement("update evaluation_transactions set is_iterated = true where instrument_number='" . $new_trans->first()->instrument_number . "'");
                        $evaluationTransaction->is_iterated = 1;
                    } elseif ($new_trans->count() > 1) {
                        $evaluationTransaction->is_iterated = 1;
                    }

                    if ($old_trans->count() == 1) {
                        \DB::statement("update evaluation_transactions set is_iterated = false where instrument_number='" . $old_trans->first()->instrument_number . "'");
                    }
                    if (!$new_trans->count() and !$old_trans->count()) {
                        $evaluationTransaction->is_iterated = 0;
                    }
                } elseif (is_numeric($evaluationTransaction->instrument_number) and !is_numeric($evaluationTransaction->getOriginal('instrument_number'))) {
                    if ($new_trans->count() == 1) {
                        \DB::statement("update evaluation_transactions set is_iterated = true where instrument_number='" . $new_trans->first()->instrument_number . "'");
                        $evaluationTransaction->is_iterated = 1;
                    } elseif ($new_trans->count() > 1) {
                        $evaluationTransaction->is_iterated = 1;
                    }
                } elseif (!is_numeric($evaluationTransaction->instrument_number) and is_numeric($evaluationTransaction->getOriginal('instrument_number'))) {
                    if ($old_trans->count() == 1) {
                        \DB::statement("update evaluation_transactions set is_iterated = false where instrument_number='" . $old_trans->first()->instrument_number . "'");
                    }
                } else {
                    $evaluationTransaction->is_iterated = false;
                }
            }
        });
    }

    /**
     * Enforce per-field assignment locks and sync lock columns when the current user may edit.
     *
     * @throws ValidationException
     */
    public function assertAndApplyRoleAssignmentLocksForUpdate(): void
    {
        $uid = auth()->id();
        foreach (self::roleAssignmentLockMap() as $role => $lock) {
            if (!$this->isDirty($role)) {
                continue;
            }
            if ($uid === null) {
                throw ValidationException::withMessages([
                    $role => [__('admin.evaluation-transactions.role_assignment_locked_no_auth')],
                ]);
            }
            $lockHolder = $this->getOriginal($lock);
            if ($lockHolder !== null && (int) $lockHolder !== (int) $uid) {
                throw ValidationException::withMessages([
                    $role => [__('admin.evaluation-transactions.role_assignment_locked')],
                ]);
            }
            $newValue = $this->getAttribute($role);
            if ($newValue === null) {
                $this->setAttribute($lock, null);
            } else {
                $this->setAttribute($lock, $uid);
            }
        }
    }

    public function scopeFilters(Builder $builder, array $filters): void
    {
        $builder->when($filters['employee_id'] ?? false, function (Builder $builder, $employee_id) {
            $builder->where(function (Builder $builder) use ($employee_id) {
                $builder->where('review_id', $employee_id)->orWhere('previewer_id', $employee_id)->orWhere('income_id', $employee_id)->orWhere('approver_id', $employee_id);
            });
        })->when($filters['company_id'] ?? false, function (Builder $builder, $comp_id) {
            $builder->whereIn('evaluation_company_id', $comp_id);
        })->when(array_key_exists('status', $filters) and !is_null($filters['status']), function (Builder $builder) use ($filters) {
            $builder->where('status', '=', $filters['status']);
        })->when($filters['city_id'] ?? false, function (Builder $builder, $city) {
            $builder->where('city_id', $city);
        })->when($filters['from_date'] ?? false, function (Builder $builder, $from) {
            $builder->whereDate('updated_at', '>=', $from);
        })->when($filters['to_date'] ?? false, function (Builder $builder, $to) {
            $builder->whereDate('updated_at', '<=', $to);
        })->when($filters['created_at_from'] ?? false, function (Builder $builder, $created_at_from) {
            $builder->whereDate('created_at' . '>=', $created_at_from);
        })->when($filters['created_at_to'] ?? false, function (Builder $builder, $created_at_to) {
            $builder->whereDate('created_at', '<=', $created_at_to);
        })->when($filters['transaction_number'] ?? false, function (Builder $builder, $transaction_number) {
            $builder->where('transaction_number', 'LIKE', '%' . $transaction_number . '%');
        });
    }


    public function type()
    {
        return $this->belongsTo(Category::class, 'type_id');
    }

    public function city()
    {
        return $this->belongsTo(Category::class, 'city_id');
    }

    public function newCity()
    {
        return $this->belongsTo(City::class, 'new_city_id');
    }

    public function company()
    {
        return $this->belongsTo(EvaluationCompany::class, 'evaluation_company_id');
    }

    public function employee()
    {
        return $this->belongsTo(EvaluationEmployee::class, 'evaluation_employee_id');
    }

    public function previewer()
    {
        return $this->belongsTo(EvaluationEmployee::class, 'previewer_id');
    }

    public function files()
    {
        return $this->hasMany(Transaction_files::class, 'Transaction_id');
    }

    public function review()
    {
        return $this->belongsTo(EvaluationEmployee::class, 'review_id');
    }

    public function income()
    {
        return $this->belongsTo(EvaluationEmployee::class, 'income_id');
    }

    public function approver()
    {
        return $this->belongsTo(EvaluationEmployee::class, 'approver_id');
    }

    /**
     * Evaluation employee IDs allowed as المعتمد (replace with production IDs).
     *
     * @return list<int>
     */
    public static function approverEmployeeIds(): array
    {
        return [179, 64];
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function resolveStatusFromRoleAssignments(array $data): int
    {
        $hasPreviewer = self::filledRoleId($data, 'previewer_id');
        $hasReview = self::filledRoleId($data, 'review_id');
        $hasIncome = self::filledRoleId($data, 'income_id');
        $hasApprover = self::filledRoleId($data, 'approver_id');

        if (!$hasPreviewer && !$hasReview && !$hasIncome && !$hasApprover) {
            return self::STATUS_NEW;
        }
        if ($hasPreviewer && $hasReview && $hasIncome && $hasApprover) {
            return self::STATUS_FINISHED;
        }
        if ($hasPreviewer && $hasReview && $hasIncome) {
            return self::STATUS_UNDER_REVIEW;
        }
        if ($hasPreviewer && $hasReview) {
            return self::STATUS_UNDER_EVALUATION;
        }
        if ($hasPreviewer && !$hasReview && !$hasIncome && !$hasApprover) {
            return self::STATUS_UNDER_OBSERVATION;
        }
        if ($hasApprover) {
            return self::STATUS_FINISHED;
        }
        if ($hasIncome) {
            return self::STATUS_UNDER_REVIEW;
        }
        if ($hasReview) {
            return self::STATUS_UNDER_EVALUATION;
        }
        if ($hasPreviewer) {
            return self::STATUS_UNDER_OBSERVATION;
        }

        return self::STATUS_NEW;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public static function filledRoleId(array $data, string $key): bool
    {
        if (!array_key_exists($key, $data)) {
            return false;
        }
        $v = $data[$key];

        return $v !== null && $v !== '';
    }

    public function getStatusSpanAttribute()
    {
        if ($this->status == 0) {
            return "<span class='badge badge-pill alert-table badge-warning'>" . __('admin.NewTransaction') . "</span>";
        } elseif ($this->status == 1) {
            return "<span class='badge badge-pill alert-table badge-info'>" . __('admin.InReviewRequest') . "</span>";
        } elseif ($this->status == 2) {
            return "<span class='badge badge-pill alert-table badge-primary'>" .
                __('admin.ContactedRequest') . "</span>";
        } elseif ($this->status == 3) {
            return "<span class='badge badge-pill alert-table badge-danger'>" .
                __('admin.ReviewedRequest') . "</span>";
        } elseif ($this->status == 4) {
            return "<span class='badge badge-pill alert-table badge-success'>" .
                __('admin.FinishedRequest') . "</span>";
        } elseif ($this->status == 5) {
            return "<span class='badge badge-pill alert-table badge-warning'>" .
                __('admin.PendingRequest') . "</span>";
        } elseif ($this->status == 6) {
            return "<span class='badge badge-pill alert-table badge-warning'>" .
                __('admin.Cancelled') . "</span>";
        } elseif ($this->status == 7) {
            return "<span class='badge badge-pill alert-table badge-secondary'>" .
                __('admin.UnderObservationRequest') . "</span>";
        } elseif ($this->status == 8) {
            return "<span class='badge badge-pill alert-table badge-primary'>" .
                __('admin.UnderEvaluationRequest') . "</span>";
        } elseif ($this->status == 9) {
            return "<span class='badge badge-pill alert-table badge-info'>" .
                __('admin.UnderReviewWorkflowRequest') . "</span>";
        }

        return '';
    }

    public function getIteratedSpanAttribute($value)
    {
        if (is_numeric($this->instrument_number)) {
            if (EvaluationTransaction::where('instrument_number', $this->instrument_number)->count() > 1) {
                $value = "<span class='badge badge-pill badge-danger'> نعم</span>";
            } else {
                $value = "<span class='badge badge-pill badge-success'>لا</span>";
            }
        } else {
            $value = "<span class='badge badge-pill badge-success'>لا</span>";
        }


        return $value;
    }

    public function getStatusWordsAttribute(): string
    {
        if ($this->status == 0) {
            return __('admin.NewTransaction');
        } elseif ($this->status == 1) {
            return __('admin.InReviewRequest');
        } elseif ($this->status == 2) {
            return __('admin.ContactedRequest');
        } elseif ($this->status == 3) {
            return __('admin.ReviewedRequest');
        } elseif ($this->status == 4) {
            return __('admin.FinishedRequest');
        } elseif ($this->status == 5) {
            return __('admin.PendingRequest');
        } elseif ($this->status == 6) {
            return __('admin.Cancelled');
        } elseif ($this->status == 7) {
            return __('admin.UnderObservationRequest');
        } elseif ($this->status == 8) {
            return __('admin.UnderEvaluationRequest');
        } elseif ($this->status == 9) {
            return __('admin.UnderReviewWorkflowRequest');
        } else {
            return '';
        }
    }

    public function getIsiteratedNameAttribute(): string
    {
        return $this->is_iterated ? __('admin.Yes') : __('admin.No');
    }

    public function getRegionAttributeAttribute(): string
    {
        if ($this->region)
            return $this->region;
        else {
            $value = '<div><strong>المدينة:</strong> ' . $this->newCity->name_ar . '</div>';
            $value = $value . '<div><strong>رقم المخطط:</strong> ' . Str::limit($this->plan_no, 12) . '</div>';
            $value = $value . '<div><strong>رقم القطعة:</strong> ' . Str::limit($this->plot_no, 12) . '</div>';
            return $value;
        }
    }

    public function getRegionTableValueAttribute(): string
    {
        if ($this->region)
            return $this->region;
        else {
            $value = $this->newCity->name_ar . ' - مخطط رقم: ' . $this->plan_no;
            return $value;
        }
    }
    public function getDetailsSpanAttribute(): string
    {
        $output = '<strong>' . __('admin.type_id') . ':</strong> ' . \Illuminate\Support\Str::limit($this->type->title ?? '', 25) . '<br/>';
        $output .= '<strong>' . __('admin.owner_name') . ':</strong> ' . Str::limit($this->owner_name, 21) . '<br/>';
        $output .= '<strong>' . __('admin.city_id') . ':</strong> ' . Str::limit($this->city->title ?? '', 50) . '<br/>';
        $output .= '<strong>' . __('admin.previewer') . ':</strong> ' . Str::limit($this->previewer->title ?? '', 25) . '<br/>';
        $output .= '<strong>' . __('admin.review') . ':</strong> ' . Str::limit($this->review->title ?? '', 25) . '<br/>';
        $output .= '<strong>' . __('admin.income') . ':</strong> ' . Str::limit($this->income->title ?? '', 25);
        return $output;
    }
    public function getMainInfoSpanAttribute(): string
    {
        $output = '<strong>' . '#' . ':</strong> ' . $this->id . '<br/>';
        $output .= '<strong>' . __('admin.instrument_number') . ':</strong> ' . \Illuminate\Support\Str::limit($this->instrument_number, 15) . '<br/>';
        $output .= '<strong>' . __('admin.transaction_number') . ':</strong> ' . Str::limit($this->transaction_number, 15) . '<br/>';
        $output .= '<strong>' . __('admin.Phone') . ':</strong> ' . Str::limit($this->phone, 25) . '<br/>';
        $output .= '<strong>' . __('admin.CreationDate') . ':</strong> ' . \Illuminate\Support\Carbon::parse($this->created_at)->format('d/m/Y');
        return $output;
    }

    public function getCompatibleCityAttribute()
    {
        if ($this->new_city_id == null)
            return $this->region;
        return $this->newCity->name_ar;
    }

    public function getHasRepeatedInstrumentNumberAttribute()
    {
        $count = EvaluationTransaction::where('instrument_number', $this->instrument_number)->count();
        return $count > 1;
    }

    public function getHasRepeatedAddressAttribute()
    {
        $count = EvaluationTransaction::where('new_city_id', $this->new_city_id)
            ->where('plan_no', $this->plan_no)
            ->where('plot_no', $this->plot_no)
            ->count();
        return $count > 1;
    }
}
