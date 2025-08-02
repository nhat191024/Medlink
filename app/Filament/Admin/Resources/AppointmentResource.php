<?php

namespace App\Filament\Admin\Resources;

use App\Models\Appointment;
use App\Models\PatientProfile;
use App\Models\DoctorProfile;
use App\Models\Service;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

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

use App\Filament\Admin\Resources\AppointmentResource\RelationManagers;
use App\Filament\Admin\Resources\AppointmentResource\Pages\EditAppointment;
use App\Filament\Admin\Resources\AppointmentResource\Pages\ListAppointments;
use App\Filament\Admin\Resources\AppointmentResource\Pages\CreateAppointment;

use Carbon\Carbon;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';


    public static function getNavigationGroup(): string
    {
        return __('sidebar.admin.appointment_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('appointment.appointment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('appointment.appointment');
    }

    public static function getModelLabel(): string
    {
        return __('appointment.appointment');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.user.name')
                    ->label(__('appointment.fields.patient'))
                    ->sortable(),
                TextColumn::make('doctor.user.name')
                    ->label(__('appointment.fields.doctor'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('service.name')
                    ->label(__('appointment.fields.service'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('appointment.fields.status'))
                    ->badge()
                    ->state(fn($record): string => $record->status)
                    ->formatStateUsing(fn(string $state): string => [
                        'cancelled' => __('appointment.status.cancelled'),
                        'rejected' => __('appointment.status.rejected'),
                        'pending' => __('appointment.status.pending'),
                        'upcoming' => __('appointment.status.upcoming'),
                        'completed' => __('appointment.status.completed'),
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'cancelled' => 'warning',
                        'rejected' => 'danger',
                        'pending' => 'warning',
                        'upcoming' => 'info',
                        'completed' => 'success',
                    ][$state] ?? 'secondary')
                    ->icon(fn(string $state): string => [
                        'cancelled' => 'heroicon-o-x-circle',
                        'rejected' => 'heroicon-o-x-circle',
                        'pending' => 'heroicon-o-clock',
                        'upcoming' => 'heroicon-o-clock',
                        'completed' => 'heroicon-o-check-circle',
                    ][$state] ?? 'heroicon-o-question-mark-circle'),
                TextColumn::make('duration')
                    ->label(__('appointment.fields.duration'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('day_of_week')
                    ->label(__('appointment.fields.day_of_week'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('date')
                    ->label(__('appointment.fields.date'))
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        try {
                            $date = Carbon::parse($state);
                            return $date->format('d/m/y');
                        } catch (\Exception $e) {
                            return $state;
                        }
                    }),
                TextColumn::make('time')
                    ->label(__('appointment.fields.time'))
                    ->searchable(),
                TextColumn::make('reason')
                    ->label(__('appointment.fields.reason'))
                    ->searchable(),
                TextColumn::make('link')
                    ->label(__('appointment.fields.link'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('address')
                    ->label(__('appointment.fields.address'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bill.id')
                    ->label(__('appointment.fields.bill_id'))
                    ->searchable()
                    ->url(fn($record) => route('filament.admin.resources.bills.index', ['tableSearch' => $record->bill->id]))
                    ->openUrlInNewTab(),
                TextColumn::make('created_at')
                    ->label(__('appointment.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('appointment.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('appointment.fields.status'))
                    ->native(false)
                    ->options([
                        'pending' => __('appointment.status.pending'),
                        'upcoming' => __('appointment.status.upcoming'),
                        'Completed' => __('appointment.status.completed'),
                        'cancelled' => __('appointment.status.cancelled'),
                        'rejected' => __('appointment.status.rejected'),
                    ]),
                TrashedFilter::make()
                    ->native(false),
            ])
            ->actions([
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
            'index' => ListAppointments::route('/'),
            // 'create' => Pages\CreateAppointment::route('/create'),
            // 'edit' => EditAppointment::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'patient',
                'patient.user',
                'doctor',
                'doctor.user',
                'service',
                'bill'
            ])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
