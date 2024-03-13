<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:admins.index';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->authorize(can('admins.create')),
        ];
    }
}
