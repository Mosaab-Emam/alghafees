<?php

namespace App\Filament\Widgets;

use Cheesegrits\FilamentGoogleMaps\Widgets\MapWidget;

class MapPageWidget extends MapWidget
{
    protected static ?string $heading = null;

    protected static ?int $zoom = 7;

    protected array $mapConfig = [
        'draggable' => true,
        'center' => [
            'lat' => 24.7136,
            'lng' => 46.6753,
        ],
        'zoom' => 7,
        'fit' => false, // Don't auto-fit when no data
        'gmaps' => '',
        'clustering' => true,
        'mapConfig' => [],
    ];

    protected function getData(): array
    {
        return [];
    }

    protected function getFilters(): ?array
    {
        return null;
    }
}
