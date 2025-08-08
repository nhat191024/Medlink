<?php

namespace App\Filament\Doctor\Resources;

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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
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

use App\Filament\Doctor\Resources\UpcomingAppointmentResource\RelationManagers;
use App\Filament\Doctor\Resources\UpcomingAppointmentResource\Pages\ListUpcomingAppointments;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\ExamResult;
use App\Models\File as AppFile;

class UpcomingAppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Lịch hẹn sắp tới';

    protected static ?string $modelLabel = 'Lịch hẹn sắp tới';

    protected static ?string $pluralModelLabel = 'Lịch hẹn sắp tới';

    protected static ?int $navigationSort = 2;

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
                    ->sortable(),
                TextColumn::make('service.name')
                    ->label(__('appointment.fields.service'))
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('appointment.fields.status'))
                    ->badge()
                    ->state(fn($record): string => $record->status)
                    ->formatStateUsing(fn(string $state): string => [
                        'upcoming' => 'Sắp tới',
                        'waiting' => 'Đang chờ',
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'upcoming' => 'info',
                        'waiting' => 'warning',
                    ][$state] ?? 'secondary'),
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
                    ->label(__('appointment.fields.time'))
                    ->searchable(),
                TextColumn::make('medical_problem')
                    ->label(__('appointment.fields.medical_problem')),
                TextColumn::make('hours_until_appointment')
                    ->label('Thời gian còn lại')
                    ->state(function ($record) {
                        try {
                            // Extract only the start time if time contains a range
                            $timeParts = preg_split('/\s*-\s*/', $record->time);
                            $startTime = $timeParts[0] ?? $record->time;
                            $appointmentDateTime = Carbon::parse("{$record->date} {$startTime}");
                            $hoursUntil = Carbon::now()->diffInHours($appointmentDateTime, false);

                            if ($hoursUntil < 0) {
                                return 'Đã qua';
                            } elseif ($hoursUntil < 24) {
                                return "{$hoursUntil} giờ";
                            } else {
                                $days = floor($hoursUntil / 24);
                                return "{$days} ngày";
                            }
                        } catch (\Exception) {
                            return 'N/A';
                        }
                    })
                    ->color(function ($record) {
                        try {
                            $timeParts = preg_split('/\s*-\s*/', $record->time);
                            $startTime = $timeParts[0] ?? $record->time;
                            $appointmentDateTime = Carbon::parse("{$record->date} {$startTime}");
                            $hoursUntil = Carbon::now()->diffInHours($appointmentDateTime, false);

                            if ($hoursUntil <= 6) {
                                return 'danger';
                            } elseif ($hoursUntil <= 24) {
                                return 'warning';
                            } else {
                                return 'success';
                            }
                        } catch (\Exception) {
                            return 'secondary';
                        }
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('appointment.fields.status'))
                    ->native(false)
                    ->options([
                        'upcoming' => 'Sắp tới',
                        'waiting' => 'Đang chờ',
                    ]),
            ])
            ->actions([
                Action::make('cancel')
                    ->label('Hủy lịch hẹn')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(function ($record) {
                        try {
                            // Extract only the start time if time contains a range
                            $timeParts = preg_split('/\s*-\s*/', $record->time);
                            $startTime = $timeParts[0] ?? $record->time;
                            $appointmentDateTime = Carbon::parse("{$record->date} {$startTime}");
                            $hoursUntil = Carbon::now()->diffInHours($appointmentDateTime, false);
                            return $hoursUntil > 6;
                        } catch (\Exception) {
                            return false;
                        }
                    })
                    ->form([
                        Textarea::make('cancel_reason')
                            ->label('Lý do hủy')
                            ->required()
                            ->rows(3)
                            ->placeholder('Nhập lý do hủy lịch hẹn...'),
                    ])
                    ->action(function (array $data, Appointment $record): void {
                        $record->update([
                            'status' => 'cancelled',
                            'cancel_reason' => $data['cancel_reason']
                        ]);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hủy lịch hẹn')
                    ->modalDescription('Vui lòng nhập lý do hủy:'),
                Action::make('complete')
                    ->label('Hoàn thành')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->form([
                        RichEditor::make('result')
                            ->label('Kết quả khám')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('medication')
                            ->label('Thông tin thuốc (không bắt buộc)')
                            ->rows(3),
                        FileUpload::make('files')
                            ->label('Tệp đính kèm kết quả')
                            ->multiple()
                            ->downloadable()
                            ->previewable(true)
                            ->openable()
                            ->directory('exam-results')
                            ->disk('public'),
                    ])
                    ->action(function (array $data, Appointment $record): void {
                        DB::transaction(function () use ($data, $record) {
                            // Update status
                            $record->update(['status' => 'completed']);

                            // Create or update exam result
                            $examResult = $record->examResult()->updateOrCreate([], [
                                'result' => $data['result'],
                                'medication' => $data['medication'] ?? null,
                            ]);

                            // Attach uploaded files
                            $paths = $data['files'] ?? [];
                            foreach ($paths as $path) {
                                $mime = Storage::disk('public')->mimeType($path) ?? null;
                                $size = Storage::disk('public')->size($path) ?? null;
                                $examResult->files()->create([
                                    'disk' => 'public',
                                    'path' => $path,
                                    'original_name' => basename($path),
                                    'mime_type' => $mime,
                                    'size' => $size,
                                    'uploaded_by' => Auth::id(),
                                ]);
                            }
                        });
                    })
                    ->modalHeading('Nhập kết quả khám')
                    ->modalSubmitActionLabel('Lưu và hoàn thành'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListUpcomingAppointments::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('doctor_profile_id', Auth::user()->doctorProfile->id)
            ->whereIn('status', ['upcoming', 'waiting'])
            ->with([
                'patient',
                'patient.user',
                'service',
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
