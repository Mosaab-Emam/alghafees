<?php

namespace App\Filament\Resources\FileResource\Pages;

use App\Filament\Resources\FileResource;
use App\Models\File;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFile extends ViewRecord
{
    protected static string $resource = FileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('download')
                ->label(__('resources/file.download'))
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function (File $record) {
                    return response()->download(public_path($record->file));
                }),
        ];
    }
}
