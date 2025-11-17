<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'longitude',
        'latitude',
        'contract_date',
        'area',
        'annual_rent',
        'contract_number',
    ];

    protected $casts = [
        'longitude' => 'decimal:7',
        'latitude' => 'decimal:7',
        'area' => 'decimal:2',
        'contract_date' => 'date',
    ];

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
