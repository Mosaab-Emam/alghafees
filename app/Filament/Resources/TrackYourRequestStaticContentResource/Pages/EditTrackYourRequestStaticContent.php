<?php

namespace App\Filament\Resources\TrackYourRequestStaticContentResource\Pages;

use App\Filament\Resources\TrackYourRequestStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrackYourRequestStaticContent extends EditRecord
{
    protected static string $resource = TrackYourRequestStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
