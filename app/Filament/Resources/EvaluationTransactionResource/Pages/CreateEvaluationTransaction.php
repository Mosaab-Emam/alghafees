<?php

namespace App\Filament\Resources\EvaluationTransactionResource\Pages;

use App\Filament\Resources\EvaluationTransactionResource;
use App\Models\Evaluation\EvaluationTransaction;
use App\Models\Transaction_files;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateEvaluationTransaction extends CreateRecord
{
    protected static string $resource = EvaluationTransactionResource::class;

    protected $files = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = EvaluationTransaction::resolveStatusFromRoleAssignments($data);

        $allFourRolesFilled = EvaluationTransaction::filledRoleId($data, 'previewer_id')
            && EvaluationTransaction::filledRoleId($data, 'review_id')
            && EvaluationTransaction::filledRoleId($data, 'income_id')
            && EvaluationTransaction::filledRoleId($data, 'approver_id');

        if ($data['status'] === EvaluationTransaction::STATUS_FINISHED && $allFourRolesFilled) {
            $admin = User::find(1);
            if ($admin) {
                Notification::make()
                    ->title('الرجاء إكمال معلومات المعاملة')
                    ->body('المعاملة بالرقم: ' . $data['transaction_number'] . ' تم إكمالها')
                    ->sendToDatabase($admin);
            }
        }
        $this->files = $data['files'];
        return $data;
    }

    protected function afterCreate(): void
    {
        $files = $this->files;
        if (is_array($files) && !empty($files)) {
            foreach ($files as $file) {
                $filename = $file->store('upload/transaction', 'public');
                $extension = pathinfo($filename, PATHINFO_EXTENSION);

                Transaction_files::create([
                    'Transaction_id' => $this->record->id,
                    'path' => $filename,
                    'type' => $extension,
                ]);
            }
        }

        $super_admins = \App\Models\User::role('المدير العام')->get();

        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('معاملة تقييم جديدة')
                ->body('المدير: ' . auth()->user()->name . ' قام بإضافة معاملة تقييم جديدة')
                ->sendToDatabase($super_admins);
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
