<?php

namespace App\Filament\Resources\HomeStaticContentResource\Pages;

use App\Filament\Resources\HomeStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeStaticContents extends ListRecords
{
    protected static string $resource = HomeStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
