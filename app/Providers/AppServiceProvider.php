<?php

namespace App\Providers;

use Filament\Notifications\Livewire\Notifications;
use Filament\Support\Assets\Css;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;


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

        FilamentView::registerRenderHook(
            PanelsRenderHook::BODY_END,
            fn (): string => "<script>
            var last_count = null;
            var first_time = true;
            setInterval(function () {
                var notifications_count_el = document.querySelector('.fi-icon-btn-badge-ctn > span:nth-child(1) > span:nth-child(1) > span:nth-child(1)');
                if (notifications_count_el == null) return;

                if (last_count == null) {
                last_count = notifications_count_el.innerText;
                }
                else {
                    if (Number(notifications_count_el.innerText) > Number(last_count)) {
                        last_count = Number(notifications_count_el.innerText);
                        if (first_time)
                            first_time = false;
                        else {
                            var audio = new Audio('/message-notification.mp3');
                            audio.play()
                        }
                    }
                }
            }, 1000);

            // Translate widget names
            if (window.location.pathname.includes('shield/roles')) {
                console.log(document.querySelectorAll('span.fi-fo-checkbox-list-option-label')[0].innerText.trim());
            }
            </script>"
        );
    }
}
