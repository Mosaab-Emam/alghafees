<?php

namespace App\Filament\Resources\FileResource\Pages;

use App\Filament\Resources\FileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListFiles extends ListRecords
{
    protected static string $resource = FileResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(__('resources/file.all')),
            'reports' => Tab::make(__('resources/file.reports'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'report')),
            'evaluations' => Tab::make(__('resources/file.evaluations'))
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'evaluation')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
