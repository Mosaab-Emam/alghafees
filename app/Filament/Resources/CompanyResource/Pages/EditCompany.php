<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Models\ServiceCompany;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->authorize(can('companies.delete')),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $services = ServiceCompany::where('company_id', $data['id'])->pluck('service_id');
        $data['services'] = $services;
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $services = $data['services'];

        $company = $this->record;
        if ($services) {
            ServiceCompany::where('company_id', $company->id)
                ->whereNotIn('service_id',  $services)->delete();

            foreach ($services as $id) {
                ServiceCompany::updateOrCreate(
                    ['company_id' => $company->id, 'service_id' => $id],
                    ['company_id' => $company->id, 'service_id' => $id]
                );
            }
        }

        return $data;
    }
}
