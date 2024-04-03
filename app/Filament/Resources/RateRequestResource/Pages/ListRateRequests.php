<?php

namespace App\Filament\Resources\RateRequestResource\Pages;

use App\Filament\Resources\RateRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRateRequests extends ListRecords
{
    protected static string $resource = RateRequestResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:rates.index';

    protected function getFooterWidgets(): array
    {
        return [
            RateRequestResource\Widgets\RateRequestsStatusChart::class,
            RateRequestResource\Widgets\RateRequestsTypeChart::class,
            RateRequestResource\Widgets\RateRequestsPurposeChart::class,
            RateRequestResource\Widgets\RateRequestsEntityChart::class,
            RateRequestResource\Widgets\RateRequestsUsageChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
