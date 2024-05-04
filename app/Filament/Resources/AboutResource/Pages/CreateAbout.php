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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = Constants::AboutType;
        $data['slug'] = Str::slug($data['title'], '-');
        return  $data;
    }

    protected function afterCreate(): void
    {
        $super_admins = \App\Models\User::role('المدير العام')->get();

        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('جديد في "عنا"')
                ->body('المدير: ' . auth()->user()->name . ' قام بإضافة عنصر جديد في "عنا"')
                ->sendToDatabase($super_admins);
    }
}
