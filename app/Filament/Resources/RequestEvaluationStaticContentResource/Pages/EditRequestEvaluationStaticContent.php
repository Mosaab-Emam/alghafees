<?php

namespace App\Filament\Resources\RequestEvaluationStaticContentResource\Pages;

use App\Filament\Resources\RequestEvaluationStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestEvaluationStaticContent extends EditRecord
{
    protected static string $resource = RequestEvaluationStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
