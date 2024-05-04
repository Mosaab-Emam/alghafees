<?php

namespace App\Filament\Resources\EvaluationEmployeeResource\Pages;

use App\Filament\Resources\EvaluationEmployeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvaluationEmployee extends CreateRecord
{
    protected static string $resource = EvaluationEmployeeResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function afterCreate(): void
    {
        $super_admins = \App\Models\User::role('المدير العام')->get();

        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('موظف تقييم جديد')
                ->body('المدير: ' . auth()->user()->name . ' قام بإضافة موظف تقييم جديد')
                ->sendToDatabase($super_admins);
    }
}
