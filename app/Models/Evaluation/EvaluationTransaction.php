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
use Str;


class EvaluationTransaction extends Model
{

    use HasFactory;

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
    protected static function booted(): void
    {
        static::creating(function (EvaluationTransaction $evaluationTransaction) {
            if (is_numeric($evaluationTransaction->instrument_number) and EvaluationTransaction::where('instrument_number', $evaluationTransaction->instrument_number)->count()) {
                \DB::update('update evaluation_transactions set is_iterated=1 where instrument_number=?', [$evaluationTransaction->instrument_number]);
                $evaluationTransaction->is_iterated = true;
            }
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

    public function scopeFilters(Builder $builder, array $filters): void
    {
        $builder->when($filters['employee_id'] ?? false, function (Builder $builder, $employee_id) {
            $builder->where(function (Builder $builder) use ($employee_id) {
                $builder->where('review_id', $employee_id)->orWhere('previewer_id', $employee_id)->orWhere('income_id', $employee_id);
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
        }
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
            $value = $value . '<div><strong>رقم المخطط:</strong> ' .  Str::limit($this->plan_no, 12) . '</div>';
            $value = $value . '<div><strong>رقم القطعة:</strong> ' .  Str::limit($this->plot_no, 12) . '</div>';
            return $value;
        }
    }
    public function getDetailsSpanAttribute(): string
    {
        $output = '<strong>' . __('admin.type_id') . ':</strong> ' . \Illuminate\Support\Str::limit($this->type->title ?? '', 25) . '<br/>';
        $output .= '<strong>' . __('admin.owner_name') . ':</strong> ' . Str::limit($this->owner_name, 21) . '<br/>';
        $output .= '<strong>' . __('admin.city_id') . ':</strong> ' . Str::limit($this->city->title ?? '', 50) . '<br/>';
        $output .= '<strong>' . __('admin.previewer') . ':</strong> ' . Str::limit($this->previewer->title ?? '', 25)  .  '<br/>';
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

    public function getCompatiblePlanNoAttribute()
    {
        if ($this->plan_no == null)
            return 'N/A';
        return $this->plan_no;
    }
    public function getCompatiblePlotNoAttribute()
    {
        if ($this->plot_no == null)
            return 'N/A';
        return $this->plot_no;
    }
}
