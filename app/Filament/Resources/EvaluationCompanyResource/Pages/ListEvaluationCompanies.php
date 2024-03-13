<?php

namespace App\Filament\Resources\EvaluationCompanyResource\Pages;

use App\Filament\Resources\EvaluationCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvaluationCompanies extends ListRecords
{
    protected static string $resource = EvaluationCompanyResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:evaluation-companies.index';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
