<?php

namespace App\Filament\Resources\FaqStaticContentsResource\Pages;

use App\Filament\Resources\FaqStaticContentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFaqStaticContents extends EditRecord
{
    protected static string $resource = FaqStaticContentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
