<?php

namespace App\Filament\Resources\ObjectiveResource\Pages;

use App\Filament\Resources\ObjectiveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectives extends ListRecords
{
    protected static string $resource = ObjectiveResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:objectives.index';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->authorize(can('objectives.create')),
        ];
    }
}
