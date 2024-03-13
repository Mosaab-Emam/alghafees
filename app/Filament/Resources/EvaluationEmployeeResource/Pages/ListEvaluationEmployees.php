<?php

namespace App\Filament\Resources\EvaluationEmployeeResource\Pages;

use App\Filament\Resources\EvaluationEmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvaluationEmployees extends ListRecords
{
    protected static string $resource = EvaluationEmployeeResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:evaluation-employees.index';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
