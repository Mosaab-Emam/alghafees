<?php

namespace App\Filament\Resources\RateRequestResource\Pages;

use App\Filament\Resources\RateRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRateRequest extends ViewRecord
{
    protected static string $resource = RateRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('downloadInstrumentImages')
                ->label(__('admin.rate-requests.instrument_images'))
                ->action(fn() => $this->record->getMedia('instrument_image')[0])
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary')
                ->hidden(empty($this->record->instrumentImages)),
            Actions\Action::make('downloadConstructionImages')
                ->label(__('admin.rate-requests.construction_images'))
                ->action(fn() => $this->record->getMedia('construction_license')[0])
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary')
                ->hidden(empty($this->record->constructionImages)),
            Actions\Action::make('downloadOtherImages')
                ->label(__('admin.rate-requests.other_images'))
                ->action(fn() => $this->record->getMedia('other_contracts')[0])
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary')
                ->hidden(empty($this->record->otherImages)),
        ];
    }
}
