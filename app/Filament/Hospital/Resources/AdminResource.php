<?php

namespace App\Filament\Hospital\Resources;

use App\Models\Admin;
use App\Models\Hospital;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Hospital\Resources\AdminResource\RelationManagers;
use App\Filament\Hospital\Resources\AdminResource\Pages\ListAdmins;
use App\Filament\Hospital\Resources\AdminResource\Pages\CreateAdmin;

use Illuminate\Support\Facades\Auth;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): string
    {
        return __('sidebar.admin.user_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.admin.accounts');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.admin.accounts');
    }

    public static function getModelLabel(): string
    {
        return __('common.admin.accounts');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('admin.fields.name'))
                    ->required()
                    ->maxLength(255)
                    ->placeholder(__('admin.placeholders.name')),
                TextInput::make('email')
                    ->label(__('admin.fields.email'))
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->placeholder(__('admin.placeholders.email')),
                TextInput::make('password')
                    ->label(__('admin.fields.password'))
                    ->password()
                    ->required(fn($context) => $context === 'create')
                    ->maxLength(255)
                    ->placeholder(__('admin.placeholders.password'))
                    ->dehydrateStateUsing(fn($state) => bcrypt($state)),
                Select::make('role')
                    ->label(__('admin.fields.role'))
                    ->options([
                        'hr' => __('admin.roles.hr'),
                        'supervisor' => __('admin.roles.supervisor'),
                    ])
                    ->native(false)
                    ->required(),
                TextInput::make('hospital_id')
                    ->default(fn() => Auth::guard('hospital')->user()->id)
                    ->hidden()
                    ->dehydrated(true),
                FileUpload::make('avatar')
                    ->image()
                    ->directory('uploads/avatars')
                    ->label(__('admin.placeholders.avatar'))
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('avatar')
                    ->label(__('common.admin.avatar'))
                    ->formatStateUsing(function (Admin $record) {
                        if ($record->avatar) {
                            $url = asset($record->avatar);
                            return '<img src="' . e($url) . '" alt="Logo" style="height:80px;max-width:100px;object-fit:contain;border-radius:4px;">';
                        }
                        return '';
                    })
                    ->html()
                    ->placeholder('N/A'),
                TextColumn::make('role')
                    ->label(__('admin.fields.role'))
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => [
                        'hr' => __('admin.roles.hr'),
                        'supervisor' => __('admin.roles.supervisor'),
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'hr' => 'info',
                        'supervisor' => 'warning',
                    ][$state] ?? 'secondary'),
                TextColumn::make('deleted_at')
                    ->label(__('common.admin.status'))
                    ->badge()
                    ->state(fn($record): string => $record->trashed() ? 'suspended' : 'active')
                    ->formatStateUsing(fn(string $state): string => [
                        'active' => __('common.admin.active'),
                        'suspended' => __('common.admin.suspended'),
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'active' => 'success',
                        'suspended' => 'danger',
                    ][$state] ?? 'secondary')
                    ->icon(fn(string $state): string => [
                        'active' => 'heroicon-o-check-circle',
                        'suspended' => 'heroicon-o-no-symbol',
                    ][$state] ?? 'heroicon-o-question-mark-circle'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.created_at')),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.updated_at')),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label(__('admin.fields.role'))
                    ->options([
                        'hr' => __('admin.roles.hr'),
                        'supervisor' => __('admin.roles.supervisor'),
                    ])
                    ->native(false),
                TrashedFilter::make()
                    ->label(__('common.admin.suspend_filter'))
                    ->trueLabel(__('common.admin.suspend_filter_all'))
                    ->falseLabel(__('common.admin.suspend_filter_only'))
                    ->native(false),
            ])
            ->actions([
                EditAction::make()
                    ->color('warning'),
                DeleteAction::make()
                    ->icon('heroicon-o-no-symbol')
                    ->label(__('common.admin.suspend'))
                    ->requiresConfirmation()
                    ->modalHeading(__('common.admin.suspend_modal_heading'))
                    ->modalDescription(__('common.admin.suspend_modal_description'))
                    ->successNotificationTitle(__('common.admin.suspend_success')),
                RestoreAction::make()
                    ->icon('heroicon-o-arrow-path')
                    ->label(__('common.admin.reactivate'))
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading(__('common.admin.restore_modal_heading'))
                    ->modalDescription(__('common.admin.restore_modal_description'))
                    ->successNotificationTitle(__('common.admin.restore_success')),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdmins::route('/'),
            // 'create' => CreateAdmin::route('/create'),
            // 'edit' => EditAdmin::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereNot('role', 'admin')
            ->where('hospital_id', Auth::guard('hospital')->user()->id)
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
