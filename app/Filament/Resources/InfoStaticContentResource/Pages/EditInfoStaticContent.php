<?php

namespace App\Filament\Resources\InfoStaticContentResource\Pages;

use App\Filament\Resources\InfoStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfoStaticContent extends EditRecord
{
    protected static string $resource = InfoStaticContentResource::class;

    protected function getHeaderActions(): array
    {

        return [
            //
        ];
    }
}
