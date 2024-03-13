<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected static string | array $routeMiddleware = [
        'checkPermission:goals.create',
        'checkPermission:types.create',
        'checkPermission:entities.create',
        'checkPermission:usages.create',
        'checkPermission:cities.create',
    ];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['title'], '-');
        return $data;
    }
}
