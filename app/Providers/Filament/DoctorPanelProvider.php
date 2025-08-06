<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\Pages;
use Filament\Widgets;
use Filament\PanelProvider;
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

class DoctorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('doctor')
            ->path('doctor')
            ->login()

            ->colors([
                'primary' => Color::Red,
            ])
            ->maxContentWidth(MaxWidth::Full)

            ->discoverResources(in: app_path('Filament/Doctor/Resources'), for: 'App\\Filament\\Doctor\\Resources')
            ->discoverPages(in: app_path('Filament/Doctor/Pages'), for: 'App\\Filament\\Doctor\\Pages')
            ->discoverWidgets(in: app_path('Filament/Doctor/Widgets'), for: 'App\\Filament\\Doctor\\Widgets')

            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
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
                        \App\Livewire\DoctorProfileComponent::class,
                    ])
            ])

            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')

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
            ]);
    }
}
