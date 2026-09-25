<?php

namespace App\Filament\Resources\EvaluationTransactionResource\Pages;

use App\Filament\Resources\EvaluationTransactionResource;
use App\Models\Evaluation\EvaluationTransaction;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewEvaluationTransaction extends ViewRecord
{
    protected static string $resource = EvaluationTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return array_merge(
            parent::getHeaderActions(),
            [
                Actions\Action::make('setCancelled')
                    ->label(__('admin.evaluation-transactions.actions.set_cancelled'))
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading(__('admin.evaluation-transactions.actions.set_cancelled_heading'))
                    ->modalDescription(__('admin.evaluation-transactions.actions.set_cancelled_description'))
                    ->visible(function (): bool {
                        $record = $this->getRecord();
                        if ((int) $record->status === EvaluationTransaction::STATUS_CANCELLED) {
                            return false;
                        }

                        return auth()->user()?->can('update', $record) ?? false;
                    })
                    ->action(function (): void {
                        $this->getRecord()->update(['status' => EvaluationTransaction::STATUS_CANCELLED]);
                        Notification::make()
                            ->title(__('admin.evaluation-transactions.actions.set_cancelled_success'))
                            ->success()
                            ->send();
                        $this->redirect(static::getResource()::getUrl('view', ['record' => $this->getRecord()]));
                    }),
            ]
        );
    }
}
