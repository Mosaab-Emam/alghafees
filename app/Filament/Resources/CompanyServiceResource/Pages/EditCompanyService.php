<?php

namespace App\Filament\Resources\CompanyServiceResource\Pages;

use App\Filament\Resources\CompanyServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditCompanyService extends EditRecord
{
    protected static string $resource = CompanyServiceResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = Str::slug($data['title'], '-');
        return $data;
    }
}
