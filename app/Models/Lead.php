<?php

namespace App\Models;

use App\Support\LeadContactData;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    protected $fillable = ['name', 'lead_category_id', 'phones', 'emails', 'notes'];

    protected $casts = ['phones' => 'array', 'emails' => 'array'];

    protected static function booted(): void
    {
        static::saving(function (Lead $lead): void {
            $lead->name = LeadContactData::trim($lead->name);
            $lead->phones = array_values(array_unique(array_map(
                fn (string $phone): string => LeadContactData::phone($phone), $lead->phones ?? [],
            )));
            $lead->emails = array_values(array_unique(array_map(
                fn (string $email): string => mb_strtolower(LeadContactData::trim($email)), $lead->emails ?? [],
            )));
            $lead->notes = filled($lead->notes) ? LeadContactData::trim($lead->notes) : null;
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(LeadCategory::class, 'lead_category_id');
    }
}
