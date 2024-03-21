<?php

namespace App\Filament\Resources\EvaluationTransactionResource\Pages;

use App\Filament\Resources\EvaluationTransactionResource;
use App\Models\ServiceCompany;
use App\Models\Transaction_files;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvaluationTransaction extends EditRecord
{
    protected static string $resource = EvaluationTransactionResource::class;


    protected static string | array $routeMiddleware = 'checkPermission:evaluation-transactions.edit';
    protected $old_files = [];

    protected function mutateFormDataBeforeFill(array $data): array
    {

        $data['uploaded_files'] =  Transaction_files::where('transaction_id', $data['id'])->pluck('id');
        $this->old_files = $data['uploaded_files']->toArray();
        return $data;
    }



    protected function mutateFormDataBeforeSave(array $data): array
    {

        if ($data['review_id'] != null) {
            $status = 4;
        } elseif ($data['previewer_id'] != null) {
            $status = 3;
        } else {
            $status = 0;
        }
        $data['status'] = $status;

        $old_files = Transaction_files::where('transaction_id', $this->record->id)->get();
        $updated_files = $data['uploaded_files']; // this is the new array after user deleted the files from select
        foreach ($old_files as $file) {
            if (!in_array($file->id, $updated_files)) {
                Transaction_files::find($file->id)->delete();
            }
        }
        $files = $data['files'];
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



        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
