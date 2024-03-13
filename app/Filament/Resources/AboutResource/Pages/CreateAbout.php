<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use App\Helpers\Constants;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateAbout extends CreateRecord
{
    protected static string $resource = AboutResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:about.create';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = Constants::AboutType;
        $data['slug'] = Str::slug($data['title'], '-');
        return  $data;
    }
}
