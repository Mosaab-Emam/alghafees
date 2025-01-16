<?php

namespace App\Filament\Resources\ContactUsStaticContentResource\Pages;

use App\Filament\Resources\ContactUsStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactUsStaticContent extends EditRecord
{
    protected static string $resource = ContactUsStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
