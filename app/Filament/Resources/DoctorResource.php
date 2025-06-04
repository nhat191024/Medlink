<?php

namespace App\Filament\Resources;

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
use App\Filament\Resources\DoctorResource\Pages\EditDoctor;
use App\Filament\Resources\DoctorResource\Pages\ListDoctors;
use App\Filament\Resources\DoctorResource\Pages\CreateDoctor;


class DoctorResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                TextColumn::make('country')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.country')),
                TextColumn::make('city')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.city')),
                TextColumn::make('state')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.admin.state')),
                TextColumn::make('doctorProfile.professional_number')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label(__('doctor.admin.professional_number')),
                TextColumn::make('doctorProfile.medicalCategory.name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label(__('doctor.admin.medical_category')),
                TextColumn::make('status')
                    ->label(__('common.admin.status'))
                    ->badge()
                    ->state(function ($record): string {
                        if ($record->trashed()) {
                            return 'suspended';
                        }
                        return $record->status;
                    })
                    ->formatStateUsing(fn(string $state): string => [
                        'active' => __('common.admin.active'),
                        'waiting-approval' => __('common.admin.waiting-approval'),
                        'suspended' => __('common.admin.suspended'),
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'active' => 'success',
                        'waiting-approval' => 'warning',
                        'suspended' => 'danger',
                    ][$state] ?? 'secondary')
                    ->icon(fn(string $state): string => [
                        'active' => 'heroicon-o-check-circle',
                        'waiting-approval' => 'heroicon-o-clock',
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
                SelectFilter::make('status')
                    ->options([
                        'active' => __('common.admin.active'),
                        'waiting-approval' => __('common.admin.waiting-approval'),
                    ])
                    ->native(false)
                    ->label(__('common.admin.status')),
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
                    ->visible(fn(User $record): bool => $record->status === 'waiting-approval')
                    ->modalHeading(__('common.admin.view_image'))
                    ->modalContent(fn(User $record) => view('filament.resources.doctor-resource.partials.view-doctor-image', ['record' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel(__('common.close'))
                    ->closeModalByClickingAway(false)
                    ->color('info')
                    ->modalIcon('heroicon-o-camera'),
                Action::make('approve')
                    ->label(__('common.admin.approve'))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (User $record) {
                        $record->status = 'active';
                        $record->save();
                    })
                    ->visible(fn(User $record): bool => $record->status === 'waiting-approval'),
                DeleteAction::make()
                    ->icon('heroicon-o-no-symbol')
                    ->label(__('common.admin.suspend'))
                    ->requiresConfirmation()
                    ->modalHeading(__('common.admin.suspend_modal_heading'))
                    ->modalDescription(__('common.admin.suspend_modal_description'))
                    ->successNotificationTitle(__('common.admin.suspend_success'))
                    ->visible(fn(User $record): bool => $record->status === 'active' && !$record->trashed()),
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
            ])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
