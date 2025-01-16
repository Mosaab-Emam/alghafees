<?php

namespace App\Filament\Resources\OurClientsStaticContentResource\Pages;

use App\Filament\Resources\OurClientsStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOurClientsStaticContent extends EditRecord
{
    protected static string $resource = OurClientsStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
