<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:roles.index';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->authorize(can('roles.create')),
        ];
    }
}
