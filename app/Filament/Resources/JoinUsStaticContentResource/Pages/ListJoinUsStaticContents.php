<?php

namespace App\Filament\Resources\JoinUsStaticContentResource\Pages;

use App\Filament\Resources\JoinUsStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJoinUsStaticContents extends ListRecords
{
    protected static string $resource = JoinUsStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
