<?php

namespace App\Filament\Resources\ContactUsStaticContentResource\Pages;

use App\Filament\Resources\ContactUsStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactUsStaticContents extends ListRecords
{
    protected static string $resource = ContactUsStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
