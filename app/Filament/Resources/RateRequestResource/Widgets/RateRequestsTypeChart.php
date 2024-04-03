<?php

namespace App\Filament\Resources\RateRequestResource\Widgets;

use App\Models\Category;
use App\Models\RateRequest;
use Filament\Widgets\ChartWidget;

class RateRequestsTypeChart extends ChartWidget
{
    protected static ?string $heading = 'نوع العقار';

    protected function getData(): array
    {
        $ids = Category::apartmentType()->pluck('id')->toArray();
        $labels = Category::apartmentType()->pluck('title')->toArray();
        $data = [];

        foreach ($ids as $id) {
            array_push($data, RateRequest::where('type_id', $id)->count());
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
