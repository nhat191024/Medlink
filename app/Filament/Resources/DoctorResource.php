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
        return __('doctor.admin.doctor');
    }

    public static function getPluralModelLabel(): string
    {
        return __('doctor.admin.doctor');
    }

    public static function getModelLabel(): string
    {
        return __('doctor.admin.doctor');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //no need form because admin cannot add / edit doctor
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('doctor.admin.name')),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label(__('doctor.admin.email')),
                TextColumn::make('phone')
                    ->searchable()
                    ->label(__('doctor.admin.phone')),
                TextColumn::make('country')
                    ->label(__('doctor.admin.country'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('city')
                    ->label(__('doctor.admin.city'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('state')
                    ->label(__('doctor.admin.state'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('doctorProfile.professional_number')
                    ->label(__('doctor.admin.professional_number'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                TextColumn::make('doctorProfile.medicalCategory.name')
                    ->label(__('doctor.admin.medical_category'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),
                TextColumn::make('status')
                    ->label(__('doctor.admin.status'))
                    ->badge()
                    ->state(function ($record): string {
                        if ($record->trashed()) {
                            return 'suspended';
                        }
                        return $record->status;
                    })
                    ->formatStateUsing(fn(string $state): string => [
                        'active' => __('doctor.admin.active'),
                        'waiting-approval' => __('doctor.admin.waiting-approval'),
                        'suspended' => __('doctor.admin.suspended'),
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
                    ->label(__('doctor.admin.created_at')),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('doctor.admin.updated_at')),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => __('doctor.admin.active'),
                        'waiting-approval' => __('doctor.admin.waiting-approval'),
                    ])
                    ->native(false)
                    ->label(__('doctor.admin.status')),
                TrashedFilter::make()
                    ->label(__('doctor.admin.suspend_filter'))
                    ->trueLabel(__('doctor.admin.suspend_filter_all'))
                    ->falseLabel(__('doctor.admin.suspend_filter_only'))
                    ->native(false),
                //
            ])
            ->actions([
                Action::make('approve')
                    ->label(__('doctor.admin.approve'))
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
                    ->label(__('doctor.admin.suspend'))
                    ->requiresConfirmation()
                    ->modalHeading(__('doctor.admin.suspend_modal_heading'))
                    ->modalDescription(__('doctor.admin.suspend_modal_description'))
                    ->successNotificationTitle(__('doctor.admin.suspend_success')),
                RestoreAction::make()
                    ->icon('heroicon-o-arrow-path')
                    ->label(__('doctor.admin.restore'))
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading(__('doctor.admin.restore_modal_heading'))
                    ->modalDescription(__('doctor.admin.restore_modal_description'))
                    ->successNotificationTitle(__('doctor.admin.restore_success')),
                ForceDeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->label(__('doctor.admin.delete_permanently'))
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading(__('doctor.admin.delete_modal_heading'))
                    ->modalDescription(__('doctor.admin.delete_modal_description'))
                    ->successNotificationTitle(__('doctor.admin.delete_success')),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('doctor.admin.suspend'))
                        ->icon('heroicon-o-no-symbol'),
                    ForceDeleteBulkAction::make()
                        ->label(__('doctor.admin.delete_permanently'))
                        ->icon('heroicon-o-trash'),
                    RestoreBulkAction::make()
                        ->label(__('doctor.admin.restore'))
                        ->icon('heroicon-o-arrow-path')
                        ->color('success'),
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
