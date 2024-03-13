<?php

namespace App\Filament\Resources\EvaluationTransactionResource\Pages;

use App\Filament\Resources\EvaluationTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEvaluationTransaction extends ViewRecord
{
    protected static string $resource = EvaluationTransactionResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:evaluation-transactions.show';


}
