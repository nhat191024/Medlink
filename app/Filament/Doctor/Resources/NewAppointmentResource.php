<?php

namespace App\Filament\Doctor\Resources;

use App\Models\Appointment;
use App\Models\PatientProfile;
use App\Models\DoctorProfile;
use App\Models\Service;
use App\Models\User;

use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\Resource;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

use Filament\Tables\Columns\TextColumn;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;

use Filament\Notifications\Notification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Filament\Doctor\Resources\NewAppointmentResource\RelationManagers;
use App\Filament\Doctor\Resources\NewAppointmentResource\Pages\ListNewAppointments;

use Carbon\Carbon;

use App\Helper\MailHelper;

class NewAppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Lịch hẹn mới';

    protected static ?string $modelLabel = 'Lịch hẹn mới';

    protected static ?string $pluralModelLabel = 'Lịch hẹn mới';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): string
    {
        return __('sidebar.admin.appointment_management');
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
                    ->required()
                    ->disabled(),
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
                    ->disabled(),
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
                    ->disabled(),
                DatePicker::make('date')
                    ->label(__('appointment.fields.date'))
                    ->displayFormat('d/m/Y')
                    ->format('Y-m-d')
                    ->required()
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.user.name')
                    ->label(__('appointment.fields.patient'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('service.name')
                    ->label(__('appointment.fields.service'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->label(__('appointment.fields.date'))
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        try {
                            $date = Carbon::parse($state);
                            return $date->format('d/m/Y');
                        } catch (\Exception $e) {
                            return $state;
                        }
                    }),
                TextColumn::make('time')
                    ->label(__('appointment.fields.time')),
                TextColumn::make('medical_problem')
                    ->label(__('appointment.fields.medical_problem')),
                TextColumn::make('files_count')
                    ->label('Tệp đính kèm')
                    ->counts('files')
                    ->badge()
                    ->color('info'),
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('view_files')
                    ->label('Xem files')
                    ->icon('heroicon-o-document-text')
                    ->color('info')
                    ->modalHeading('Files đính kèm')
                    ->modalWidth('4xl')
                    ->modalContent(function (Appointment $record) {
                        $files = $record->files;

                        if ($files->isEmpty()) {
                            return view('filament.components.no-files');
                        }

                        return view('filament.components.appointment-files', compact('files'));
                    })
                    ->modalSubmitAction(false)
                    ->visible(fn(Appointment $record) => $record->files->count() > 0),
                Action::make('approve')
                    ->label('Đồng ý')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function (Appointment $record): void {
                        $record->update(['status' => 'upcoming']);

                        // Get patient and doctor information
                        $patientProfile = PatientProfile::find($record->patient_profile_id);
                        $doctorProfile = DoctorProfile::find($record->doctor_profile_id);
                        $patient = User::find($patientProfile->user_id ?? null);
                        $doctor = User::find($doctorProfile->user_id ?? null);

                        // Send notifications to patient
                        if ($patient) {
                            $patient->notify(
                                Notification::make()
                                    ->title('Lịch hẹn đã được chấp nhận')
                                    ->body(
                                        "Lịch hẹn của bạn với bác sĩ {$doctor->name} vào ngày {$record->date} lúc {$record->time} đã được chấp nhận."
                                    )
                                    ->success()
                                    ->toDatabase()
                            );

                            // Send email to patient
                            $patientEmail = config('app.env') === 'production' ? $patient->email : 'richberchannel01@gmail.com';
                            MailHelper::sendNotification(
                                $patientEmail,
                                'Lịch hẹn đã được chấp nhận',
                                "Lịch hẹn của bạn với bác sĩ {$doctor->name} vào ngày {$record->date} lúc {$record->time} đã được chấp nhận. Vui lòng có mặt đúng giờ.",
                                null,
                                null
                            );
                        }

                        // Send notification to doctor
                        if ($doctor) {
                            $doctor->notify(
                                Notification::make()
                                    ->title('Đã chấp nhận lịch hẹn')
                                    ->body(
                                        "Bạn đã chấp nhận lịch hẹn với bệnh nhân {$patient->name} vào ngày {$record->date} lúc {$record->time}."
                                    )
                                    ->success()
                                    ->toDatabase()
                            );
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Xác nhận lịch hẹn')
                    ->modalDescription('Bạn có chắc chắn muốn đồng ý lịch hẹn này?'),
                Action::make('reject')
                    ->label('Từ chối')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->form([
                        Textarea::make('reject_reason')
                            ->label('Lý do từ chối')
                            ->required()
                            ->rows(3)
                            ->placeholder('Nhập lý do từ chối lịch hẹn...'),
                    ])
                    ->action(function (array $data, Appointment $record): void {
                        $record->update([
                            'status' => 'rejected',
                            'reason' => $data['reject_reason']
                        ]);

                        // Get patient and doctor information
                        $patientProfile = PatientProfile::find($record->patient_profile_id);
                        $doctorProfile = DoctorProfile::find($record->doctor_profile_id);
                        $patient = User::find($patientProfile->user_id ?? null);
                        $doctor = User::find($doctorProfile->user_id ?? null);

                        // Send notifications to patient
                        if ($patient) {
                            $patient->notify(
                                Notification::make()
                                    ->title('Lịch hẹn đã bị từ chối')
                                    ->body(
                                        "Lịch hẹn của bạn với bác sĩ {$doctor->name} vào ngày {$record->date} lúc {$record->time} đã bị từ chối."
                                    )
                                    ->success()
                                    ->toDatabase()
                            );

                            // Send email to patient
                            $patientEmail = config('app.env') === 'production' ? $patient->email : 'richberchannel01@gmail.com';
                            MailHelper::sendNotification(
                                $patientEmail,
                                'Lịch hẹn đã bị từ chối',
                                "Lịch hẹn của bạn với bác sĩ {$doctor->name} vào ngày {$record->date} lúc {$record->time} đã bị từ chối. Vui lòng liên hệ với bác sĩ để biết thêm chi tiết.",
                                null,
                                null
                            );
                        }

                        // Send notification to doctor
                        if ($doctor) {
                            $doctor->notify(
                                Notification::make()
                                    ->title('Đã từ chối lịch hẹn')
                                    ->body(
                                        "Bạn đã từ chối lịch hẹn với bệnh nhân {$patient->name} vào ngày {$record->date} lúc {$record->time}."
                                    )
                                    ->success()
                                    ->toDatabase()
                            );
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Từ chối lịch hẹn')
                    ->modalDescription('Vui lòng nhập lý do từ chối:'),
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
            'index' => ListNewAppointments::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('doctor_profile_id', Auth::user()->doctorProfile->id)
            ->where('status', 'pending')
            ->whereHas('bill', function ($query) {
                $query->where('status', 'paid');
            })
            ->orderBy('created_at', 'desc')
            ->with([
                'patient',
                'patient.user',
                'service',
                'files',
                'bill',
            ])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
