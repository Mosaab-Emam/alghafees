<?php

namespace App\Filament\Resources\EvaluationTransactionResource\Pages;

use App\Filament\Resources\EvaluationTransactionResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListEvaluationTransactions extends ListRecords
{
    protected static string $resource = EvaluationTransactionResource::class;

    /* protected static string $view = 'filament.pages.evaluation-transactions';*/

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('admin.evaluation-transactions.statuses.all')),
            '0' => Tab::make(__('admin.evaluation-transactions.statuses.0'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 0)),
            '1' => Tab::make(__('admin.evaluation-transactions.statuses.1'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 1)),
            '2' => Tab::make(__('admin.evaluation-transactions.statuses.2'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 2)),
            '3' => Tab::make(__('admin.evaluation-transactions.statuses.3'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 3)),
            '4' => Tab::make(__('admin.evaluation-transactions.statuses.4'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 4)),
            '5' => Tab::make(__('admin.evaluation-transactions.statuses.5'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 5)),
            '6' => Tab::make(__('admin.evaluation-transactions.statuses.6'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 6)),
        ];
    }
}
