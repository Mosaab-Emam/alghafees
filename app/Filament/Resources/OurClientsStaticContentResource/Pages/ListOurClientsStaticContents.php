<?php

namespace App\Filament\Resources\OurClientsStaticContentResource\Pages;

use App\Filament\Resources\OurClientsStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOurClientsStaticContents extends ListRecords
{
    protected static string $resource = OurClientsStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
