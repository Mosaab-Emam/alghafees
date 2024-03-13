<?php

namespace App\Filament\Widgets;

use App\Models\RateRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;
    protected function getStats(): array
    {
        $totalRequests = RateRequest::count();
        $CancelledRequests = RateRequest::Refused()->count();
        $CancelledRequestsPercentage =  number_format(($CancelledRequests / $totalRequests)*100,2);

        $SuccessRequests = RateRequest::Contacted()->count();
        $SuccessRequestsPercentage =  number_format(($SuccessRequests / $totalRequests)*100,2);

        $PendingRequests = RateRequest::Pending()->count();
        $PendingRequestsPercentage =  number_format(($PendingRequests/ $totalRequests)*100,2);


        return [
            Stat::make('كل طلبات التقييم', $totalRequests)
                ->description('100 %')
                ->descriptionIcon('heroicon-m-arrow-trending-up') // Change to an appropriate icon
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),

            Stat::make('طلبات التقييم المنتهية', $SuccessRequests)
                ->description($SuccessRequestsPercentage.' %')
                ->descriptionIcon('heroicon-m-check-circle') // Change to an appropriate icon
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

            Stat::make('طلبات التقييم قيد الإنتظار', $PendingRequests)
                ->description($PendingRequestsPercentage.' %')
                ->descriptionIcon('heroicon-o-clock') // Change to an appropriate icon
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('warning'),

            Stat::make('طلبات التقييم الملغاة', $CancelledRequests)
                ->description($CancelledRequestsPercentage.' %')
                ->descriptionIcon('heroicon-m-x-circle') // Change to an appropriate icon
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger')

        ];
    }
}
