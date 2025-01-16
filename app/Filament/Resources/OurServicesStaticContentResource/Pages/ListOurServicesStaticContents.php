<?php

namespace App\Filament\Resources\OurServicesStaticContentResource\Pages;

use App\Filament\Resources\OurServicesStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOurServicesStaticContents extends ListRecords
{
    protected static string $resource = OurServicesStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
