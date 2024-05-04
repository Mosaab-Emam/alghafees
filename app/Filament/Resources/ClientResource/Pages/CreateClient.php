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

    protected function afterCreate(): void
    {
        $super_admins = \App\Models\User::role('المدير العام')->get();

        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('عميل جديد')
                ->body('المدير: ' . auth()->user()->name . ' قام بإضافة عميل جديد')
                ->sendToDatabase($super_admins);
    }
}
