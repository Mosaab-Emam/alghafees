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

    protected function afterCreate(): void
    {
        $super_admins = \App\Models\User::role('المدير العام')->get();

        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('عداد جديد')
                ->body('المدير: ' . auth()->user()->name . ' قام بإضافة عداد جديد')
                ->sendToDatabase($super_admins);
    }
}
