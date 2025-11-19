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
        return [
            [
                'location' => [
                    'lat' => 24.7136,
                    'lng' => 46.6753,
                ],
                'label' => '<div style="padding: 8px; min-width: 200px;"><strong style="font-size: 14px; display: block; margin-bottom: 6px;">Riyadh City Center</strong><div style="font-size: 12px; color: #666; line-height: 1.6;"><div><strong>ID:</strong> marker-1</div><div><strong>Coordinates:</strong> 24.7136, 46.6753</div><div style="margin-top: 4px;">Central business district</div><div style="margin-top: 8px;"><a href="https://www.google.com" target="_blank" style="color: #1976d2; text-decoration: underline;">Visit Google →</a></div></div></div>',
                'id' => 'marker-1',
                'url' => 'https://www.google.com',
            ],
            [
                'location' => [
                    'lat' => 24.6477,
                    'lng' => 46.7219,
                ],
                'label' => '<div style="padding: 8px; min-width: 200px;"><strong style="font-size: 14px; display: block; margin-bottom: 6px;">King Fahd International Stadium</strong><div style="font-size: 12px; color: #666; line-height: 1.6;"><div><strong>ID:</strong> marker-2</div><div><strong>Coordinates:</strong> 24.6477, 46.7219</div><div style="margin-top: 4px;">Major sports venue</div><div style="margin-top: 8px;"><a href="https://www.wikipedia.org" target="_blank" style="color: #1976d2; text-decoration: underline;">Visit Wikipedia →</a></div></div></div>',
                'id' => 'marker-2',
                'url' => 'https://www.wikipedia.org',
            ],
            [
                'location' => [
                    'lat' => 24.7600,
                    'lng' => 46.6400,
                ],
                'label' => '<div style="padding: 8px; min-width: 200px;"><strong style="font-size: 14px; display: block; margin-bottom: 6px;">King Abdulaziz Historical Center</strong><div style="font-size: 12px; color: #666; line-height: 1.6;"><div><strong>ID:</strong> marker-3</div><div><strong>Coordinates:</strong> 24.7600, 46.6400</div><div style="margin-top: 4px;">Cultural heritage site</div><div style="margin-top: 8px;"><a href="https://www.github.com" target="_blank" style="color: #1976d2; text-decoration: underline;">Visit GitHub →</a></div></div></div>',
                'id' => 'marker-3',
                'url' => 'https://www.github.com',
            ],
            [
                'location' => [
                    'lat' => 24.7000,
                    'lng' => 46.7000,
                ],
                'label' => '<div style="padding: 8px; min-width: 200px;"><strong style="font-size: 14px; display: block; margin-bottom: 6px;">Al Faisaliah Tower</strong><div style="font-size: 12px; color: #666; line-height: 1.6;"><div><strong>ID:</strong> marker-4</div><div><strong>Coordinates:</strong> 24.7000, 46.7000</div><div style="margin-top: 4px;">Iconic skyscraper</div><div style="margin-top: 8px;"><a href="https://www.stackoverflow.com" target="_blank" style="color: #1976d2; text-decoration: underline;">Visit Stack Overflow →</a></div></div></div>',
                'id' => 'marker-4',
                'url' => 'https://www.stackoverflow.com',
            ],
            [
                'location' => [
                    'lat' => 24.6500,
                    'lng' => 46.7500,
                ],
                'label' => '<div style="padding: 8px; min-width: 200px;"><strong style="font-size: 14px; display: block; margin-bottom: 6px;">King Khalid International Airport</strong><div style="font-size: 12px; color: #666; line-height: 1.6;"><div><strong>ID:</strong> marker-5</div><div><strong>Coordinates:</strong> 24.6500, 46.7500</div><div style="margin-top: 4px;">Main airport hub</div><div style="margin-top: 8px;"><a href="https://www.youtube.com" target="_blank" style="color: #1976d2; text-decoration: underline;">Visit YouTube →</a></div></div></div>',
                'id' => 'marker-5',
                'url' => 'https://www.youtube.com',
            ],
        ];
    }

    protected function getFilters(): ?array
    {
        return null;
    }
}
