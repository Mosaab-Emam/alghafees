<?php

namespace App\Filament\Resources\LeadCategoryResource\Pages;

use App\Filament\Resources\LeadCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeadCategory extends EditRecord
{
    protected static string $resource = LeadCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()->modalDescription(__('leads.delete_category_help'))];
    }
}
