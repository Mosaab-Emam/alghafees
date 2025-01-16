<?php

namespace App\Filament\Resources\OurServicesStaticContentResource\Pages;

use App\Filament\Resources\OurServicesStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOurServicesStaticContent extends EditRecord
{
    protected static string $resource = OurServicesStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
