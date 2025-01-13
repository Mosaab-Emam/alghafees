<?php

namespace App\Filament\Resources\HomeStaticContentResource\Pages;

use App\Filament\Resources\HomeStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomeStaticContent extends EditRecord
{
    protected static string $resource = HomeStaticContentResource::class;

    protected function getHeaderActions(): array
    {

        return [
            //
        ];
    }
}
