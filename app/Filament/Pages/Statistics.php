<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Statistics extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static string $view = 'filament.pages.statistics';

    protected ?string $heading = '';

    protected static ?int $navigationSort = 0;

    public static function getNavigationLabel(): string
    {
        return __('admin.statistics');
    }
    public function getTitle(): string
    {
        return __('admin.statistics');
    }
}
