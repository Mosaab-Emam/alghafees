<?php

namespace App\Filament\Resources\TamaraCheckoutSessionResource\Pages;

use App\Filament\Resources\TamaraCheckoutSessionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTamaraCheckoutSessions extends ListRecords
{
    protected static string $resource = TamaraCheckoutSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
