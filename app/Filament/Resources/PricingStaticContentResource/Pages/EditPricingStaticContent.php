<?php

namespace App\Filament\Resources\PricingStaticContentResource\Pages;

use App\Filament\Resources\PricingStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPricingStaticContent extends EditRecord
{
    protected static string $resource = PricingStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
