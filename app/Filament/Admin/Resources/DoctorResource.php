<?php

namespace App\Filament\Admin\Resources;

use App\Models\User;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Filament\Admin\Resources\DoctorResource\Pages\ListDoctors;

class DoctorResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): string
    {
        return __('sidebar.admin.user_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.admin.doctor');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.admin.doctor');
    }

    public static function getModelLabel(): string
    {
        return __('common.admin.doctor');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //no need form because this is a read-only resource
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.id')),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('common.admin.name')),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label(__('common.admin.email')),
                TextColumn::make('hospital.name')
                    ->searchable()
                    ->sortable()
                    ->label(__('common.admin.hospital')),
                TextColumn::make('phone')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable()
                    ->label(__('common.admin.phone')),
                TextColumn::make('doctorProfile.professional_number')
                    ->searchable()
                    ->label(__('doctor.admin.professional_number')),
                TextColumn::make('doctorProfile.medicalCategory.name')
                    ->searchable()
                    ->label(__('doctor.admin.medical_category')),
                TextColumn::make('status')
                    ->label(__('common.admin.status'))
                    ->badge()
                    ->state(function ($record): string {
                        if ($record->trashed()) {
                            return 'trashed';
                        }
                        return $record->status;
                    })
                    ->formatStateUsing(fn(string $state): string => [
                        'active' => __('common.admin.active'),
                        'waiting-approval' => __('common.admin.waiting-approval'),
                        'suspend' => __('common.admin.suspended'),
                        'trashed' => __('common.admin.locked'),
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'active' => 'success',
                        'suspend-approval' => 'warning',
                        'suspend' => 'danger',
                        'trashed' => 'danger',
                    ][$state] ?? 'secondary')
                    ->icon(fn(string $state): string => [
                        'active' => 'heroicon-o-check-circle',
                        'waiting-approval' => 'heroicon-o-clock',
                        'suspend' => 'heroicon-o-no-symbol',
                        'trashed' => 'heroicon-o-lock-closed',
                    ][$state] ?? 'heroicon-o-question-mark-circle'),
                TextColumn::make('country')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.country')),
                TextColumn::make('city')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.city')),
                TextColumn::make('ward')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.ward')),
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
                Action::make('view_doctor_image')
                    ->label(__('common.admin.view_image'))
                    ->icon('heroicon-o-eye')
                    ->modalHeading(__('common.admin.view_image'))
                    ->modalContent(fn(User $record) => view('filament.resources.doctor-resource.partials.view-doctor-image', ['record' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel(__('common.close'))
                    ->closeModalByClickingAway(false)
                    ->color('info')
                    ->modalIcon('heroicon-o-camera'),
                Action::make('suspend')
                    ->label(__('common.admin.suspend'))
                    ->icon('heroicon-o-no-symbol')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading(__('common.admin.suspend_modal_heading'))
                    ->modalDescription(__('common.admin.suspend_modal_description'))
                    ->successNotificationTitle(__('common.admin.suspend_success'))
                    ->action(function (User $record) {
                        $record->status = 'suspend';
                        $record->save();
                    })
                    ->visible(fn(User $record): bool => $record->status === 'active'),
                Action::make('activate')
                    ->label(__('common.admin.reactivate'))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (User $record) {
                        $record->status = 'active';
                        $record->save();
                    })
                    ->visible(fn(User $record): bool => $record->status === 'suspend'),
                DeleteAction::make()
                    ->icon('heroicon-o-no-symbol')
                    ->label(__('common.admin.lock_account'))
                    ->requiresConfirmation()
                    ->modalHeading(__('common.admin.lock_modal_heading'))
                    ->modalDescription(__('common.admin.lock_modal_description'))
                    ->successNotificationTitle(__('common.admin.lock_success'))
                    ->visible(fn(User $record): bool => $record->status === 'active' && !$record->trashed()),
                RestoreAction::make()
                    ->icon('heroicon-o-arrow-path')
                    ->label(__('common.admin.unlock_account'))
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading(__('common.admin.restore_modal_heading'))
                    ->modalDescription(__('common.admin.restore_modal_description'))
                    ->successNotificationTitle(__('common.admin.restore_success')),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    //
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
            'index' => ListDoctors::route('/'),
            // 'create' => CreateDoctor::route('/create'),
            // 'edit' => EditDoctor::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_type', 'healthcare')
            ->where('identity', 'doctor')
            ->with([
                'doctorProfile',
                'doctorProfile.medicalCategory',
                'hospital',
            ])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
