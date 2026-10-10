<?php

namespace App\Filament\Resources\LeadCategoryResource\Pages;

use App\Filament\Resources\LeadCategoryResource;
use App\Filament\Resources\LeadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeadCategories extends ListRecords
{
    protected static string $resource = LeadCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('contacts')->label(__('leads.plural'))->color('gray')
                ->url(fn () => LeadResource::getUrl())->visible(fn () => LeadResource::canViewAny()),
            Actions\CreateAction::make(),
        ];
    }
}
