<?php

namespace App\Filament\Resources\WorkTrackerResource\Pages;

use App\Filament\Resources\WorkTrackerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkTrackers extends ListRecords
{
    protected static string $resource = WorkTrackerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
