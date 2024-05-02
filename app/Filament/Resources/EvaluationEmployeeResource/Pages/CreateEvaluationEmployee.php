<?php

namespace App\Filament\Resources\EvaluationEmployeeResource\Pages;

use App\Filament\Resources\EvaluationEmployeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvaluationEmployee extends CreateRecord
{
    protected static string $resource = EvaluationEmployeeResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
