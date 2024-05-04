<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $super_admins = \App\Models\User::role('المدير العام')->get();

        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('مدير جديد')
                ->body('المدير: ' . auth()->user()->name . ' قام بإضافة مدير جديد')
                ->sendToDatabase($super_admins);
    }
}
