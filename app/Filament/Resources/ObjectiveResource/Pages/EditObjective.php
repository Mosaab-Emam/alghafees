<?php

namespace App\Filament\Resources\ObjectiveResource\Pages;

use App\Filament\Resources\ObjectiveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditObjective extends EditRecord
{
    protected static string $resource = ObjectiveResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:objectives.edit' ;

   protected function mutateFormDataBeforeSave(array $data): array
   {
       $data['slug'] = Str::slug($data['title'], '-');
       return $data;
   }
}
