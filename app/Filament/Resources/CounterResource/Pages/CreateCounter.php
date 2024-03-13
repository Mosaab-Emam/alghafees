<?php

namespace App\Filament\Resources\CounterResource\Pages;

use App\Filament\Resources\CounterResource;
use App\Helpers\Constants;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateCounter extends CreateRecord
{
    protected static string $resource = CounterResource::class;


    protected static string | array $routeMiddleware = 'checkPermission:counters.create' ;
    protected function getRedirectUrl(): string
    {
        return CounterResource::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['title'], '-');
        $data['type'] = Constants::CounterType;
        return $data;
    }
}
