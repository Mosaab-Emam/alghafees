<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\WorkTrackers;
use Filament\Pages\Page;

class Statistics extends Page
{
    use \BezhanSalleh\FilamentShield\Traits\HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static string $view = 'filament.pages.statistics';

    protected ?string $heading = '';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('admin.statistics');
    }
    public function getTitle(): string
    {
        return __('admin.statistics');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            WorkTrackers::class,
        ];
    }
}
