<?php

namespace App\Filament\Resources\RateRequestResource\Pages;

use App\Filament\Resources\RateRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRateRequests extends ListRecords
{
    protected static string $resource = RateRequestResource::class;

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
