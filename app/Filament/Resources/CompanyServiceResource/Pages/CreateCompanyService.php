<?php

namespace App\Filament\Resources\CompanyServiceResource\Pages;

use App\Filament\Resources\CompanyServiceResource;
use App\Helpers\Constants;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateCompanyService extends CreateRecord
{
    protected static string $resource = CompanyServiceResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:company-services.create';
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['title'], '-');
        $data['type'] = Constants::CompanyServiceType;
        return $data;
    }
}
