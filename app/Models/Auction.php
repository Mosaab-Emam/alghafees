<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Auction extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'longitude',
        'latitude',
        'instrument_number',
        'area',
        'type',
        'opening_price',
        'date',
        'highest_bid',
        'notes',
        'auction_url',
    ];

    protected $casts = [
        'longitude' => 'decimal:7',
        'latitude' => 'decimal:7',
        'area' => 'decimal:2',
        'opening_price' => 'integer',
        'highest_bid' => 'integer',
        'date' => 'date',
    ];

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
