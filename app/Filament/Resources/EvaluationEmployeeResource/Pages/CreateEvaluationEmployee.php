<?php

namespace App\Filament\Resources\EvaluationEmployeeResource\Pages;

use App\Filament\Resources\EvaluationEmployeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvaluationEmployee extends CreateRecord
{
    protected static string $resource = EvaluationEmployeeResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:evaluation-employees.index';

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
