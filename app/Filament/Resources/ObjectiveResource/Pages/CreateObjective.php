<?php

namespace App\Filament\Resources\ObjectiveResource\Pages;

use App\Filament\Resources\ObjectiveResource;
use App\Helpers\Constants;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateObjective extends CreateRecord
{
    protected static string $resource = ObjectiveResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = Constants::ObjectiveType;
        $data['slug'] = Str::slug($data['title'], '-');
        return $data;
    }
}
