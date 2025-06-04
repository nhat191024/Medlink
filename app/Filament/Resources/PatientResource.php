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

use App\Filament\Resources\PatientResource\RelationManagers;
use App\Filament\Resources\PatientResource\Pages\EditPatient;
use App\Filament\Resources\PatientResource\Pages\ListPatients;
use App\Filament\Resources\PatientResource\Pages\CreatePatient;

class PatientResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationGroup(): string
    {
        return __('sidebar.admin.user_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.admin.patient');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.admin.patient');
    }

    public static function getModelLabel(): string
    {
        return __('common.admin.patient');
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
            ->actions([
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
                    ->successNotificationTitle(__('common.admin.suspend_success')),
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
            'index' => ListPatients::route('/'),
            // 'create' => CreatePatient::route('/create'),
            // 'edit' => EditPatient::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_type', 'patient')
            // ->with([
            //     'patientProfile',
            // ]) // Uncomment if you have a patient profile relation
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
