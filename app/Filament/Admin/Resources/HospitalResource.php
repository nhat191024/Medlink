<?php

namespace App\Filament\Admin\Resources;

use App\Models\Hospital;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Resources\HospitalResource\RelationManagers;
use App\Filament\Admin\Resources\HospitalResource\Pages\EditHospital;
use App\Filament\Admin\Resources\HospitalResource\Pages\ListHospitals;
use App\Filament\Admin\Resources\HospitalResource\Pages\CreateHospital;

class HospitalResource extends Resource
{
    protected static ?string $model = Hospital::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): string
    {
        return __('sidebar.admin.user_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.admin.hospital');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.admin.hospital');
    }

    public static function getModelLabel(): string
    {
        return __('common.admin.hospital');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('common.admin.name')),
                TextInput::make('address')
                    ->required()
                    ->maxLength(255)
                    ->label(__('common.admin.address')),
                TextInput::make('city')
                    ->required()
                    ->maxLength(255)
                    ->label(__('common.admin.city')),
                TextInput::make('ward')
                    ->required()
                    ->maxLength(255)
                    ->label(__('common.admin.ward')),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->label(__('common.admin.email')),
                TextInput::make('phone')
                    ->maxLength(50)
                    ->label(__('common.admin.phone')),
                TextInput::make('website')
                    ->maxLength(255)
                    ->label(__('common.admin.website')),
                FileUpload::make('logo')
                    ->image()
                    ->directory('uploads/hospitals/logos')
                    ->label(__('common.admin.logo')),
                Textarea::make('description')
                    ->required()
                    ->maxLength(1000)
                    ->label(__('common.admin.description')),
                DatePicker::make('contract_start_date')
                    ->label(__('common.admin.contract_start_date')),
                DatePicker::make('contract_end_date')
                    ->label(__('common.admin.contract_end_date')),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('common.admin.name')),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label(__('common.admin.email')),
                TextColumn::make('phone')
                    ->searchable()
                    ->label(__('common.admin.phone')),
                TextColumn::make('city')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.city')),
                TextColumn::make('ward')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.ward')),
                TextColumn::make('website')
                    ->url(fn($record) => $record->website)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.website')),
                TextColumn::make('logo')
                    ->label(__('common.admin.logo'))
                    ->formatStateUsing(function ($state, Hospital $record) {
                        if ($record->logo) {
                            $url = asset($record->logo);
                            return '<img src="' . e($url) . '" alt="Logo" style="height:80px;max-width:100px;object-fit:contain;border-radius:4px;">';
                        }
                        return '';
                    })
                    ->html(),
                TextColumn::make('description')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.description')),
                TextColumn::make('contract_start_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.contract_start_date')),
                TextColumn::make('contract_end_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.contract_end_date')),
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
                    ->successNotificationTitle(__('common.admin.suspend_success'))
                    ->visible(fn(Hospital $record): bool => !$record->trashed()),
                RestoreAction::make()
                    ->icon('heroicon-o-arrow-path')
                    ->label(__('common.admin.reactivate'))
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading(__('common.admin.restore_modal_heading'))
                    ->modalDescription(__('common.admin.restore_modal_description'))
                    ->successNotificationTitle(__('common.admin.restore_success')),
                ForceDeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->label(__('common.admin.delete_permanently'))
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading(__('common.admin.delete_modal_heading'))
                    ->modalDescription(__('common.admin.delete_modal_description'))
                    ->successNotificationTitle(__('common.admin.delete_success')),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('common.admin.suspend'))
                        ->icon('heroicon-o-no-symbol')
                        ->modalHeading(__('common.admin.suspend_modal_heading'))
                        ->modalDescription(__('common.admin.suspend_modal_description'))
                        ->successNotificationTitle(__('common.admin.suspend_success')),
                    ForceDeleteBulkAction::make()
                        ->label(__('common.admin.delete_permanently'))
                        ->icon('heroicon-o-trash')
                        ->modalHeading(__('common.admin.delete_modal_heading'))
                        ->modalDescription(__('common.admin.delete_modal_description'))
                        ->successNotificationTitle(__('common.admin.delete_success')),
                    RestoreBulkAction::make()
                        ->label(__('common.admin.reactivate'))
                        ->icon('heroicon-o-arrow-path')
                        ->color('success')
                        ->modalHeading(__('common.admin.restore_modal_heading'))
                        ->modalDescription(__('common.admin.restore_modal_description'))
                        ->successNotificationTitle(__('common.admin.restore_success')),
                ]),
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
            'index' => ListHospitals::route('/'),
            'create' => CreateHospital::route('/create'),
            'edit' => EditHospital::route('/{record}/edit'),
        ];
    }
}
