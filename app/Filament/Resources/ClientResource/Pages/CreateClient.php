<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Helpers\Constants;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:clients.create';
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = Constants::ClientType;
        $data['slug'] = Str::slug($data['title'], '-');
        return  $data;
    }
    protected function getRedirectUrl(): string
    {
        return ClientResource::getUrl('index');
    }
}
