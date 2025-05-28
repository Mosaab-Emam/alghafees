<?php

namespace App\Filament\Resources\PricingStaticContentResource\Pages;

use App\Filament\Resources\PricingStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPricingStaticContents extends ListRecords
{
    protected static string $resource = PricingStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
