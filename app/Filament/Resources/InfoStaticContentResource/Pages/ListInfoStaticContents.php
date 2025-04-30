<?php

namespace App\Filament\Resources\InfoStaticContentResource\Pages;

use App\Filament\Resources\InfoStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfoStaticContents extends ListRecords
{
    protected static string $resource = InfoStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
