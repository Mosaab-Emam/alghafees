<?php

namespace App\Filament\Resources\EvaluationCompanyResource\Pages;

use App\Filament\Resources\EvaluationCompanyResource;
use App\Helpers\Constants;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEvaluationCompany extends CreateRecord
{
    protected static string $resource = EvaluationCompanyResource::class;

    protected function afterCreate(): void
    {
        $super_admins = \App\Models\User::role('المدير العام')->get();

        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('شركة تقييم جديدة')
                ->body('المدير: ' . auth()->user()->name . ' قام بإضافة شركة تقييم جديدة')
                ->sendToDatabase($super_admins);
    }
}
