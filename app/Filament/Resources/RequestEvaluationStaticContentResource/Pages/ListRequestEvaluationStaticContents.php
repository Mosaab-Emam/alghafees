<?php

namespace App\Filament\Resources\RequestEvaluationStaticContentResource\Pages;

use App\Filament\Resources\RequestEvaluationStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRequestEvaluationStaticContents extends ListRecords
{
    protected static string $resource = RequestEvaluationStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
