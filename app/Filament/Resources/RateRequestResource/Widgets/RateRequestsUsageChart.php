<?php

namespace App\Filament\Resources\RateRequestResource\Widgets;

use App\Models\Category;
use App\Models\RateRequest;
use Filament\Widgets\ChartWidget;

class RateRequestsUsageChart extends ChartWidget
{
    protected static ?string $heading = 'استعمال العقار';

    protected function getData(): array
    {
        $ids = Category::apartmentUsage()->pluck('id')->toArray();
        $labels = Category::apartmentUsage()->pluck('title')->toArray();
        $data = [];

        foreach ($ids as $id) {
            array_push($data, RateRequest::where('usage_id', $id)->count());
        }

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => [
                        '#8BC1F7',
                        '#BDE2B9',
                        '#A2D9D9',
                        '#519DE9',
                        '#7CC674',
                        '#73C5C5',
                        '#0066CC',
                        '#4CB140',
                        '#009596',
                        '#004B95',
                        '#38812F',
                        '#005F60',
                        '#002F5D',
                        '#23511E',
                        '#003737'
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
