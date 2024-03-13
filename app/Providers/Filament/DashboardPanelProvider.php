<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Settings;
use App\Filament\Resources\UserResource;
use App\Http\Controllers\Admin\LoginController;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Filament\Tables\View\TablesRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\Sky\SkyPlugin;
use Illuminate\Contracts\View\View;


class DashboardPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->colors([
                'primary' => "#09839a",
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label(app()->getLocale() == 'ar' ? 'النسخة الإحتياطية' : 'Backup database')
                    ->url('admin/our_backup_database')
                    ->icon('heroicon-o-circle-stack')
                ,
                // ...
            ])
            ->navigationGroups([
                // using __('') method to translate breaks skyplugin translation !!!
                NavigationGroup::make(app()->getLocale() == 'ar' ? 'معاملات التقييم' : 'Evaluation transactions'),
                NavigationGroup::make(app()->getLocale() == 'ar' ? 'إدارة المحتوى' : 'Content Management'),
                NavigationGroup::make(app()->getLocale() == 'ar' ? 'الإعدادات' : 'Settings'),

            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()->defaultLocales([config('app.locale')]),
                SkyPlugin::make()
                    ->navigationGroupLabel(
                        app()->getLocale() == 'ar' ? 'إدارة المحتوى' : 'Content Management'
                    )
            ])->brandLogo(asset('images/settings/1691238434rKMpDrJ2EhNquOPc8E04TfgLLnkyWRJpEXWNKeGP.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/logo.png'))
            ;
    }
}
