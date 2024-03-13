<?php

namespace App\Filament\Resources\EvaluationCompanyResource\Pages;

use App\Filament\Resources\EvaluationCompanyResource;
use App\Helpers\Constants;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEvaluationCompany extends CreateRecord
{
    protected static string $resource = EvaluationCompanyResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:evaluation-companies.create';

}
