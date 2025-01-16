<?php

namespace App\Filament\Resources\AboutUsStaticContentResource\Pages;

use App\Filament\Resources\AboutUsStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutUsStaticContent extends EditRecord
{
    protected static string $resource = AboutUsStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
