<?php

namespace App\Filament\Resources\EvaluationTransactionResource\Pages;

use App\Filament\Resources\EvaluationTransactionResource;
use App\Filament\Resources\ReviewTransactionResource;
use App\Models\Evaluation\EvaluationTransaction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListReviewTransactions extends ListRecords
{
    protected static string $resource = ReviewTransactionResource::class;

/*    protected static string $view = 'filament.pages.evaluation-transactions';*/

    protected static string | array $routeMiddleware = 'checkPermission:evaluation-transactions.index' ;




    protected function getHeaderActions(): array
    {
        return [
             Actions\CreateAction::make()
                 ->url(fn () : string => EvaluationTransactionResource::getUrl('create'))
                 ->authorize(can('evaluation-transactions.create')),
        ];
    }


}
