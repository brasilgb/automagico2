<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\KpisHome;
use App\Http\Middleware\AddUserMenuItems;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->maxContentWidth('full')
            ->default()
            ->id('admin')
            ->path('admin')
            ->registration()
            ->colors([
                'primary' => '#0C356A',
            ])
            ->sidebarWidth('20rem')
            ->sidebarCollapsibleOnDesktop()
            ->collapsedSidebarWidth('6rem')
            ->collapsibleNavigationGroups(false)
            // ->topNavigation()
            ->sidebarFullyCollapsibleOnDesktop()
            ->theme(asset('css/filament/admin/theme.css'))
            ->font('Poppins', provider: GoogleFontProvider::class)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                KpisHome::class,
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
                AddUserMenuItems::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->spa();
    }
}
