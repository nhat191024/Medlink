<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\Pages;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;


use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

use CWSPS154\AppSettings\AppSettingsPlugin;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class HospitalPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('hospital')
            ->path('hospital')
            ->login()

            ->colors([
                'primary' => Color::Orange,
            ])
            ->maxContentWidth(MaxWidth::Full)

            ->discoverResources(in: app_path('Filament/Hospital/Resources'), for: 'App\\Filament\\Hospital\\Resources')
            ->discoverPages(in: app_path('Filament/Hospital/Pages'), for: 'App\\Filament\\Hospital\\Pages')
            ->discoverWidgets(in: app_path('Filament/Hospital/Widgets'), for: 'App\\Filament\\Hospital\\Widgets')

            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                AccountWidget::class,
            ])

            ->plugins([
                AppSettingsPlugin::make()
                    ->canAccess(fn() => false),
                FilamentEditProfilePlugin::make()
                    ->setTitle(__('common.my_profile'))
                    ->setNavigationLabel(__('common.my_profile'))
                    ->setNavigationGroup(
                        __('common.system')
                    )
                    ->setIcon('heroicon-o-cog-6-tooth')
                    ->shouldShowDeleteAccountForm(false)
                    ->shouldShowEditProfileForm(false)
                    ->customProfileComponents([
                        \App\Livewire\HospitalProfileComponent::class,
                    ])
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
            ->authGuard('hospital');
    }
}
