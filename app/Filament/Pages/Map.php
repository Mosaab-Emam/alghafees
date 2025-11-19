<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\MapPageWidget;
use Filament\Pages\Page;

class Map extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static string $view = 'filament.pages.map';

    protected static ?int $navigationSort = 3;


    public static function getNavigationLabel(): string
    {
        return __('admin.map.title');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.map.navigation_group');
    }

    public function getTitle(): string
    {
        return __('admin.map.title');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MapPageWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|string|array
    {
        return 1;
    }
}
