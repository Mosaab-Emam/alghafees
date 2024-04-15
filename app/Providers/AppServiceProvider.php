<?php

namespace App\Providers;

use App\Filament\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\Notifications\Livewire\Notifications;
use Filament\Notifications\Notification;
use Filament\Support\Assets\Css;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        FilamentAsset::register([
            Css::make('globals', 'globals.css'),
            Css::make('admin-css', Vite::asset('resources/css/app.css', 'build'))
        ]);


        Paginator::useBootstrapFour();
        Notifications::alignment(Alignment::Right);
        Notifications::verticalAlignment(VerticalAlignment::Start);
    }
}
