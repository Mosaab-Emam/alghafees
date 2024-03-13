<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;


    protected static string | array $routeMiddleware = 'checkPermission:admins.edit';

    protected function mutateFormDataBeforeSave(array $data): array
    {

        if (!$data['password']) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        return $data;

    }

    protected function getRedirectUrl(): ?string
    {
        return UserResource::getUrl('index');
    }
}
