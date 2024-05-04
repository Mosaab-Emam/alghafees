<?php

namespace App\Filament\Resources\EvaluationTransactionResource\Pages;

use App\Filament\Resources\EvaluationTransactionResource;
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
        if (
            $data['previewer_id'] != null &&
            $data['income_id'] != null &&
            $data['review_id'] != null
        ) {
            $status = 4;

            $admin = User::find(1);
            Notification::make()
                ->title('الرجاء إكمال معلومات المعاملة')
                ->body('المعاملة بالرقم: ' . $data['transaction_number'] . ' تم إكمالها')
                ->sendToDatabase($admin);
        } else if (
            ($data['previewer_id'] != null && $data['income_id'] != null) || $data['previewer_id'] != null
        ) {
            $status = 3;
        } else {
            $status = 0;
        }
        $data['status'] = $status;
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
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
