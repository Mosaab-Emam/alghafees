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
        'start_date',
        'highest_bid',
        'notes',
        'auction_url',
        'location',
    ];

    protected $appends = [
        'location',
    ];

    protected $casts = [
        'longitude' => 'decimal:7',
        'latitude' => 'decimal:7',
        'area' => 'decimal:2',
        'opening_price' => 'integer',
        'highest_bid' => 'integer',
        'date' => 'date',
        'start_date' => 'date',
    ];

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    /**
     * Returns the 'latitude' and 'longitude' attributes as the computed 'location' attribute,
     * as a standard Google Maps style Point array with 'lat' and 'lng' attributes.
     *
     * Used by the Filament Google Maps package.
     *
     * Requires the 'location' attribute be included in this model's $fillable array.
     *
     * @return array
     */
    public function getLocationAttribute(): array
    {
        return [
            "lat" => (float) $this->latitude,
            "lng" => (float) $this->longitude,
        ];
    }

    /**
     * Takes a Google style Point array of 'lat' and 'lng' values and assigns them to the
     * 'latitude' and 'longitude' attributes on this model.
     *
     * Used by the Filament Google Maps package.
     *
     * Requires the 'location' attribute be included in this model's $fillable array.
     *
     * @param ?array $location
     * @return void
     */
    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location)) {
            $this->attributes['latitude'] = $location['lat'];
            $this->attributes['longitude'] = $location['lng'];
            unset($this->attributes['location']);
        }
    }

    /**
     * Get the latitude attribute
     *
     * @return float|null
     */
    public function getLatitudeAttribute(): ?float
    {
        return $this->attributes['latitude'] ?? null;
    }

    /**
     * Get the longitude attribute
     *
     * @return float|null
     */
    public function getLongitudeAttribute(): ?float
    {
        return $this->attributes['longitude'] ?? null;
    }

    /**
     * Get the lat and lng attribute/field names used on this table
     *
     * Used by the Filament Google Maps package.
     *
     * @return string[]
     */
    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'latitude',
            'lng' => 'longitude',
        ];
    }

    /**
     * Get the name of the computed location attribute
     *
     * Used by the Filament Google Maps package.
     *
     * @return string
     */
    public static function getComputedLocation(): string
    {
        return 'location';
    }
}
