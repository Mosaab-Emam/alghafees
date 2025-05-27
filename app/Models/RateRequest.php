<?php

namespace App\Models;

use App\Helpers\Constants;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RateRequest extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', // Legacy
        'first_name',
        'last_name',
        'email',
        'mobile',
        'address',
        'notes',
        'real_estate_details',
        'entity_id',
        'usage_id',
        'type_id',
        'goal_id',
        'real_estate_age',
        'real_estate_area',
        'status',
        'request_no',
        'longitude',
        'latitude',
        'location', // Legacy
        'estate_city',
        'estate_region',
        'estate_line_1',
        'estate_line_2',
    ];

    public function usage()
    {
        return $this->belongsTo(Category::class, 'usage_id');
    }

    public function goal()
    {
        return $this->belongsTo(Category::class, 'goal_id');
    }


    public function entity()
    {
        return $this->belongsTo(Category::class, 'entity_id');
    }


    public function type()
    {
        return $this->belongsTo(Category::class, 'type_id');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function getFullNameAttribute()
    {
        if ($this->is_using_legacy_name) {
            return $this->name;
        }
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getIsUsingLegacyNameAttribute()
    {
        return $this->name !== null;
    }

    public function getIsUsingLegacyLocationAttribute()
    {
        return $this->location !== null;
    }


    public function getStatusTitleAttribute()
    {
        $statusId = $this->status;
        $title = '';
        foreach (Constants::Statuses as $status) {
            if ($status['id'] == $statusId) {
                $title = $status['title'];
                break;
            }
        }
        return $title !== '' ? __('admin.' . $title) : '';
    }
    public function getStatusSpanAttribute()
    {
        if ($this->status == 0) {
            return "<span class='badge badge-pill alert-table badge-warning'>" .
                __('admin.NewRequest') . "</span>";
        } elseif ($this->status == 1) {
            return "<span class='badge badge-pill alert-table badge-info'>" .
                __('admin.NewWorkRequest') . "</span>";
        } elseif ($this->status == 2) {
            return "<span class='badge badge-pill alert-table badge-danger'>" .
                __('admin.InEvaluationRequest') . "</span>";
        } elseif ($this->status == 3) {
            return "<span class='badge badge-pill alert-table badge-success'>" .
                __('admin.CheckedRequest') . "</span>";
        } elseif ($this->status == 4) {
            return "<span class='badge badge-pill alert-table badge-danger'>" .
                __('admin.SuspendedRequest') . "</span>";
        }

        //
    }
    public function getClientSpanAttribute()
    {
        return "<p>" .
            "<strong class='text-dark'>الاسم:</strong> .$this->name" .
            "</p>" .
            "<p>" .
            "<strong class='text-dark'>البريد الإلكتروني:</strong> .$this->email" .
            "</p>" .
            "<p>" .
            "<strong class='text-dark'>رقم الجوال:</strong>  .$this->mobile" .
            "<a href='https://wa.me/966{$this->mobile}'><i class='fa fa-whatsapp fa-2x mx-1' style='color:#25d366'></i></a>" .
            "<a href='tel:966$this->mobile'><i class='fa fa-mobile fa-2x mx-1' style='color:#1d8496'></i></a>" .
            "</p>";
    }
    public function getClientTitleSpanAttribute()
    {
        $clientTitle = __('الاسم: ') . $this->name;
        $clientEmail = __('البريد الإلكتروني: ') . $this->email;
        $clientMobile = __('رقم الجوال: ') . $this->mobile;

        return $clientTitle . PHP_EOL . $clientEmail . PHP_EOL . $clientMobile;
    }

    public function getApartmentTitleSpanAttribute()
    {
        $apartmentGoal = __('admin.ApartmentGoal') . ': ' . ($this->goal ? $this->goal->title : '');
        $apartmentType = __('admin.ApartmentType') . ': ' . ($this->type ? $this->type->title : '');
        $apartmentEntity = __('admin.ApartmentEntity') . ': ' . ($this->entity ? $this->entity->title : '');
        $apartmentAge = __('admin.ApartmentAge') . ': ' . $this->real_estate_age;
        $apartmentArea = __('admin.ApartmentArea') . ': ' . $this->real_estate_area;
        $apartmentUsed = __('admin.ApartmentUsed') . ': ' . ($this->usage ? $this->usage->title : '');

        return $apartmentGoal . PHP_EOL . $apartmentType . PHP_EOL . $apartmentEntity . PHP_EOL . $apartmentAge . PHP_EOL . $apartmentArea . PHP_EOL . $apartmentUsed;
    }


    public function getApartmentSpanAttribute()
    {
        return "<p>" .
            "<strong class='text-dark'>" . __('admin.ApartmentGoal') . ":</strong> " . ($this->goal ? $this->goal->title : '') .
            "</p>" .
            "<p>" .
            "<strong class='text-dark'>" . __('admin.ApartmentType') . ":</strong> " . ($this->type ? $this->type->title : '') .
            "</p>" .
            "<p>" .
            "<strong class='text-dark'>" . __('admin.ApartmentEntity') . ":</strong> " . ($this->entity ? $this->entity->title : '') .
            "</p>" .
            "<p>" .
            "<strong class='text-dark'>" . __('admin.ApartmentAge') . ":</strong> " . $this->real_estate_age .
            "</p>" .
            "<p>" .
            "<strong class='text-dark'>" . __('admin.ApartmentArea') . ":</strong> " . $this->real_estate_area .
            "</p>" .
            "<p>" .
            "<strong class='text-dark'>" . __('admin.ApartmentUsed') . ":</strong> " . ($this->usage ? $this->usage->title : '') .
            "</p>";
    }

    public function getStatusApi()
    {
        if ($this->status == 0) {
            return
                __('admin.NewRequest');
        } elseif ($this->status == 1) {
            return
                __('admin.NewWorkRequest');
        } elseif ($this->status == 2) {
            return
                __('admin.InEvaluationRequest');
        } elseif ($this->status == 3) {
            return
                __('admin.CheckedRequest');
        } elseif ($this->status == 4) {
            return
                __('admin.SuspendedRequest');
        }

        //
    }

    public function scopeRefused($query)
    {
        return $query->where('status', Constants::RefusedRequest);
    }

    public function scopePending($query)
    {
        return $query->where('status', Constants::PendingRequest);
    }

    public function scopeInReview($query)
    {
        return $query->where('status', Constants::InReviewRequest);
    }

    public function scopeContacted($query)
    {
        return $query->where('status', Constants::ContactedRequest);
    }


    public function dateFormatted($format = 'M d, Y', $filedDate = 'created_at', $showTimes = false)
    {
        if ($showTimes) {
            $format = $format . ' @ h:i a';
        }
        setLocale(LC_ALL, 'ar_EG.utf-8');
        return date($format, strtotime($this->$filedDate));
    }

    // 'instrument_image',
    // 'construction_license',
    // 'other_contracts',
    public function getOtherImagesAttribute()
    {
        $images = [];
        $files = $this->getMedia('other_contracts');
        if (!empty($files)) {
            foreach ($files as $file) {
                array_push($images, $file->getFullUrl());
            }
        }

        return $images;
    }

    public function getInstrumentImagesAttribute()
    {
        $images = [];
        $files = $this->getMedia('instrument_image');
        if (!empty($files)) {
            foreach ($files as $file) {
                array_push($images, $file->getFullUrl());
            }
        }

        return $images;
    }

    public function getConstructionImagesAttribute()
    {
        $images = [];
        $files = $this->getMedia('construction_license');
        if (!empty($files)) {
            foreach ($files as $file) {
                array_push($images, $file->getFullUrl());
            }
        }

        return $images;
    }
}
