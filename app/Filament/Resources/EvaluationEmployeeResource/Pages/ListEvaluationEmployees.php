<?php

namespace App\Filament\Resources\EvaluationEmployeeResource\Pages;

use App\Filament\Resources\EvaluationEmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvaluationEmployees extends ListRecords
{
    protected static string $resource = EvaluationEmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
