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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['title'], '-');
        $data['type'] = Constants::CompanyServiceType;
        return $data;
    }

    protected function afterCreate(): void
    {
        $super_admins = \App\Models\User::role('المدير العام')->get();

        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('خدمة شركات جديدة')
                ->body('المدير: ' . auth()->user()->name . ' قام بإضافة خدمة شركات جديدة')
                ->sendToDatabase($super_admins);
    }
}
