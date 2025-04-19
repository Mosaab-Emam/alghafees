<?php

namespace App\Filament\Resources\WorkTrackerResource\Pages;

use App\Filament\Resources\WorkTrackerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkTracker extends EditRecord
{
    protected static string $resource = WorkTrackerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
