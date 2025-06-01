<?php

namespace App\Filament\Settings\Forms;

use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;

class MobileAppUrl
{
    /**
     * @return Tab
     */
    public static function getTab(): Tab
    {
        return Tab::make('mobile_app_url')
            ->label(__('common.mobile_app_url'))
            ->icon('heroicon-o-computer-desktop')
            ->schema(self::getFields())
            ->columns()
            ->statePath('mobile_app_url')
            ->visible(true);
    }

    public static function getFields(): array
    {
        return [
            TextInput::make('app_url')
                ->label(__('common.app_url'))
                ->placeholder('https://example.com')
                ->maxLength(250)
                ->required()
                ->columnSpanFull(),
            TextInput::make('play_store_url')
                ->label(__('common.play_store_url'))
                ->placeholder('https://play.google.com/store/apps/details?id=com.example.app')
                ->maxLength(250)
                ->required()
                ->columnSpanFull(),
            TextInput::make('app_store_url')
                ->label(__('common.app_store_url'))
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
