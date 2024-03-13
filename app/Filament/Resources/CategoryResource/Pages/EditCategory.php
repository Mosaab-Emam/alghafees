<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Helpers\Constants;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

   protected function mutateFormDataBeforeSave(array $data): array
   {
       $data['slug'] = Str::slug($data['title'], '-');
       return $data;
   }
}
