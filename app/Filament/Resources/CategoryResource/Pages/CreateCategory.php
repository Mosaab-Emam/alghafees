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

    protected function afterCreate(): void
    {
        $super_admins = \App\Models\User::role('المدير العام')->get();

        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('إعداد عقار جديد')
                ->body('المدير: ' . auth()->user()->name . ' قام بإضافة إعداد عقار')
                ->sendToDatabase($super_admins);
    }
}
