<?php

namespace App\Filament\Resources\PricePackageResource\Pages;

use App\Filament\Resources\PricePackageResource;
use App\Models\PricePackage;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPricePackage extends EditRecord
{
    protected static string $resource = PricePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\RestoreAction::make()
                ->label(__('resources/price_packages.restore')),
            Actions\DeleteAction::make()
                ->label(__('resources/price_packages.archive'))
                ->modalHeading(__('resources/price_packages.archive_confirm_heading'))
                ->modalDescription(__('resources/price_packages.archive_confirm_description'))
                ->hidden(fn (): bool => PricePackage::count() <= 1)
                ->requiresConfirmation(),
        ];
    }
}
