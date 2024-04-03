<?php

namespace App\Filament\Resources\RateRequestResource\Widgets;

use App\Models\RateRequest;
use Filament\Widgets\ChartWidget;

class RateRequestsStatusChart extends ChartWidget
{
    protected static ?string $heading = 'الحالة';

    protected function getData(): array
    {
        $statuses = [0, 1, 2, 3, 4];
        $data = [];

        foreach ($statuses as $status) {
            array_push($data, RateRequest::where('status', $status)->count());
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
                        'rgba(255, 99, 132)'
                    ],
                ],
            ],
            'labels' => [
                __('admin.NewRequest'),
                __('admin.NewWorkRequest'),
                __('admin.InEvaluationRequest'),
                __('admin.CheckedRequest'),
                __('admin.SuspendedRequest')
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
