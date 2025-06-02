<?php

namespace App\Filament\Resources;

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

use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Filament\Resources\AppointmentResource\Pages\EditAppointment;
use App\Filament\Resources\AppointmentResource\Pages\ListAppointments;
use App\Filament\Resources\AppointmentResource\Pages\CreateAppointment;

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
                Select::make('patient_profile_id')
                    ->label(__('appointment.fields.patient'))
                    ->options(function () {
                        return PatientProfile::with('user')
                            ->whereHas('user', function ($query) {
                                $query->where('identity', 'patient');
                            })
                            ->get()
                            ->mapWithKeys(function ($patientProfile) {
                                return [$patientProfile->id => $patientProfile->user->name];
                            });
                    })
                    ->searchable()
                    ->required(),
                Select::make('doctor_profile_id')
                    ->label(__('appointment.fields.doctor'))
                    ->options(function () {
                        return DoctorProfile::with('user')
                            ->whereHas('user', function ($query) {
                                $query->where('identity', 'doctor');
                            })
                            ->get()
                            ->mapWithKeys(function ($doctorProfile) {
                                return [$doctorProfile->id => $doctorProfile->user->name];
                            });
                    })
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('service_id', null)),
                Select::make('service_id')
                    ->label(__('appointment.fields.service'))
                    ->options(function (callable $get) {
                        $doctorProfileId = $get('doctor_profile_id');
                        if (!$doctorProfileId) {
                            return [];
                        }
                        return Service::where('doctor_profile_id', $doctorProfileId)
                            ->where('is_active', true)
                            ->get()
                            ->mapWithKeys(function ($service) {
                                return [$service->id => $service->name];
                            });
                    })
                    ->searchable()
                    ->required()
                    ->disabled(fn(callable $get): bool => !$get('doctor_profile_id')),
                Select::make('status')
                    ->label(__('appointment.fields.status'))
                    ->options([
                        'pending' => __('appointment.status.pending'),
                        'upcoming' => __('appointment.status.upcoming'),
                        'Completed' => __('appointment.status.completed'),
                        'cancelled' => __('appointment.status.cancelled'),
                        'rejected' => __('appointment.status.rejected'),
                    ])
                    ->native(false)
                    ->required(),
                DatePicker::make('date')
                    ->label(__('appointment.fields.date'))
                    ->displayFormat('d/m/Y')
                    ->format('Y-m-d')
                    ->required(),
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
                        'Completed' => __('appointment.status.completed'),
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'cancelled' => 'warning',
                        'rejected' => 'danger',
                        'pending' => 'warning',
                        'upcoming' => 'info',
                        'Completed' => 'success',
                    ][$state] ?? 'secondary')
                    ->icon(fn(string $state): string => [
                        'cancelled' => 'heroicon-o-x-circle',
                        'rejected' => 'heroicon-o-x-circle',
                        'pending' => 'heroicon-o-clock',
                        'upcoming' => 'heroicon-o-clock',
                        'Completed' => 'heroicon-o-check-circle',
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
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
                Action::make('changeStatus')
                    ->label(__('appointment.actions.change_status'))
                    ->icon('heroicon-o-arrow-path')
                    ->color('info')
                    ->form([
                        Select::make('status')
                            ->label(__('appointment.modals.change_status.status'))
                            ->native(false)
                            ->options([
                                'pending' => __('appointment.status.pending'),
                                'upcoming' => __('appointment.status.upcoming'),
                                'Completed' => __('appointment.status.completed'),
                                'cancelled' => __('appointment.status.cancelled'),
                                'rejected' => __('appointment.status.rejected'),
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data, Appointment $record): void {
                        $record->update(['status' => $data['status']]);
                    })
                    ->requiresConfirmation()
                    ->modalHeading(__('appointment.modals.change_status.title'))
                    ->modalDescription(
                        __('appointment.modals.change_status.description')
                    ),
                DeleteAction::make()
                    ->icon('heroicon-o-no-symbol')
                    ->requiresConfirmation()
                    ->visible(fn(Appointment $record): bool => !$record->trashed()),
                RestoreAction::make()
                    ->icon('heroicon-o-arrow-path')
                    ->color('success'),
                ForceDeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->color('danger'),
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
            ])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
