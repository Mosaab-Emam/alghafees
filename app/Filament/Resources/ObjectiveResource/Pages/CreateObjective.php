<?php

namespace App\Filament\Resources\ObjectiveResource\Pages;

use App\Filament\Resources\ObjectiveResource;
use App\Helpers\Constants;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateObjective extends CreateRecord
{
    protected static string $resource = ObjectiveResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = Constants::ObjectiveType;
        $data['slug'] = Str::slug($data['title'], '-');
        return $data;
    }

    protected function afterCreate(): void
    {
        $super_admins = \App\Models\User::role('المدير العام')->get();

        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('هدف جديد')
                ->body('المدير: ' . auth()->user()->name . ' قام بإضافة هدف جديد')
                ->sendToDatabase($super_admins);
    }
}
