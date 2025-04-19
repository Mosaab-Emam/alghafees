<?php

namespace App\Filament\Resources\WorkTrackerResource\Pages;

use App\Filament\Resources\WorkTrackerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewWorkTracker extends ViewRecord
{
    protected static string $resource = WorkTrackerResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
