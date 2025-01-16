<?php

namespace App\Filament\Resources\TrackYourRequestStaticContentResource\Pages;

use App\Filament\Resources\TrackYourRequestStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrackYourRequestStaticContents extends ListRecords
{
    protected static string $resource = TrackYourRequestStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
