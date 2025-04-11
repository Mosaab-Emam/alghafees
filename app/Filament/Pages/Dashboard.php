<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestOrders;
use App\Filament\Widgets\QuickActions;
use App\Filament\Widgets\StatsOverview;
use Filament\Widgets\AccountWidget;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            QuickActions::class,
            StatsOverview::class,
            LatestOrders::class,
        ];
    }
}