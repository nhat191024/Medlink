<?php

namespace App\Filament\Settings\Forms;

use Filament\Forms\Components\Tabs\Tab;

class MobileAppUrl
{
    /**
     * @return Tab
     */
    public static function getTab(): Tab
    {
        return Tab::make('mobile_app_url')
            ->label(__('Mobile App URL'))
            ->icon('heroicon-o-computer-desktop')
            ->schema(self::getFields())
            ->columns()
            ->statePath('mobile_app_url')
            ->visible(true);
    }

    public static function getFields(): array
    {
        return [
            \Filament\Forms\Components\TextInput::make('app_url')
                ->label(__('App URL'))
                ->placeholder('https://example.com')
                ->maxLength(250)
                ->required()
                ->columnSpanFull(),
            \Filament\Forms\Components\TextInput::make('play_store_url')
                ->label(__('Play Store URL'))
                ->placeholder('https://play.google.com/store/apps/details?id=com.example.app')
                ->maxLength(250)
                ->required()
                ->columnSpanFull(),
            \Filament\Forms\Components\TextInput::make('app_store_url')
                ->label(__('App Store URL'))
                ->placeholder('https://apps.apple.com/app/id1234567890')
                ->maxLength(250)
                ->required()
                ->columnSpanFull(),
        ];
    }

    public static function getSortOrder(): int
    {
        return 1;
    }
}
