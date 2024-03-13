<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;



    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'All' => Tab::make()->label('الكل'),
            'AppartmentTypes' => Tab::make()->label( __('admin.Types'))
                ->modifyQueryUsing(fn (Builder $query) => $query->apartmentType()),
             'AppartmentGoal' => Tab::make()->label( __('admin.ApartmentGoal'))
                ->modifyQueryUsing(fn (Builder $query) => $query->apartmentGoal()),
             'AppartmentEntity' => Tab::make()->label(__('admin.ApartmentEntity'))
                ->modifyQueryUsing(fn (Builder $query) => $query->apartmentEntity()),
             'Usages' => Tab::make()->label(__('admin.Usages'))
                ->modifyQueryUsing(fn (Builder $query) => $query->apartmentUsage()),
             'City' => Tab::make()->label(__('admin.city'))
                ->modifyQueryUsing(fn (Builder $query) => $query->city()),
        ];
    }
}
