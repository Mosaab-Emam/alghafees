<?php

namespace App\Filament\Resources\EventsStaticContentResource\Pages;

use App\Filament\Resources\EventsStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventsStaticContent extends EditRecord
{
    protected static string $resource = EventsStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
