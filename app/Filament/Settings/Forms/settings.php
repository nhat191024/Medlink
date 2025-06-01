<?php

namespace App\Filament\Settings\Forms;

use Filament\Forms\Components\Tabs\Tab;

use Filament\Forms\Components\TextInput;

class settings
{
    /**
     * @return Tab
     */
    public static function getTab(): Tab
    {
        return Tab::make('settings')
            ->label(__('settings'))
            ->icon('heroicon-o-computer-desktop')
            ->schema(self::getFields())
            ->columns()
            ->statePath('settings')
            ->visible(true);
    }

    public static function getFields(): array
    {
        return [
            // Define your settings fields here
            // Example:
            // TextInput::make('site_name')
            //     ->label(__('Site Name'))
            //     ->required(),
            // TextInput::make('site_email')
            //     ->label(__('Site Email'))
            //     ->email()
            //     ->required(),
        ];
    }

    public static function getSortOrder(): int
    {
        return 1;
    }
}
