<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Helpers\Constants;
use App\Models\ServiceCompany;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        $data['type'] = Constants::CompanyType;

        $company = static::getModel()::create($data);

        $services = $data['services'];

        foreach ($services as $service) {
            ServiceCompany::updateOrCreate(['company_id' => $company->id, 'service_id' => $service]);
        }

        return $company;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
