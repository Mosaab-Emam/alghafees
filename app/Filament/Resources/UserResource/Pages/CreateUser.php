<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:admins.create';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
