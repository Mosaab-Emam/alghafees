<?php

namespace App\Filament\Resources\EventsStaticContentResource\Pages;

use App\Filament\Resources\EventsStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventsStaticContents extends ListRecords
{
    protected static string $resource = EventsStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
