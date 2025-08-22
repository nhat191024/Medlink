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
use Filament\Tables\Filters\Filter;

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

use App\Filament\Doctor\Resources\AppointmentHistoryResource\RelationManagers;
use App\Filament\Doctor\Resources\AppointmentHistoryResource\Pages\ListAppointmentHistories;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\ExamResult;
use App\Models\File as AppFile;

class AppointmentHistoryResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Lịch sử khám';

    protected static ?string $modelLabel = 'Lịch sử khám';

    protected static ?string $pluralModelLabel = 'Lịch sử khám';

    protected static ?int $navigationSort = 4;

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
                    ->sortable()
                    ->searchable(),
                TextColumn::make('service.name')
                    ->label(__('appointment.fields.service'))
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
                    ->label(__('appointment.fields.time'))
                    ->searchable(),
                TextColumn::make('reason')
                    ->label(__('appointment.fields.reason'))
                    ->searchable()
                    ->limit(50),
                TextColumn::make('bill.total')
                    ->label('Tổng tiền')
                    ->money('VND')
                    ->sortable(),
                TextColumn::make('bill.status')
                    ->label('Trạng thái thanh toán')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => [
                        'pending' => 'Chờ thanh toán',
                        'paid' => 'Đã thanh toán',
                        'cancelled' => 'Đã hủy',
                        'refunded' => 'Đã hoàn tiền',
                    ][$state] ?? $state)
                    ->color(fn(string $state): string => [
                        'pending' => 'warning',
                        'paid' => 'success',
                        'cancelled' => 'danger',
                        'refunded' => 'info',
                    ][$state] ?? 'secondary'),
                TextColumn::make('files_count')
                    ->label('Tệp đính kèm')
                    ->counts('files')
                    ->badge()
                    ->color('info'),
                TextColumn::make('updated_at')
                    ->label('Ngày hoàn thành')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('from_date')
                            ->label('Từ ngày'),
                        DatePicker::make('to_date')
                            ->label('Đến ngày'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from_date'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['to_date'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    }),
                SelectFilter::make('bill.status')
                    ->label('Trạng thái thanh toán')
                    ->options([
                        'pending' => 'Chờ thanh toán',
                        'paid' => 'Đã thanh toán',
                        'cancelled' => 'Đã hủy',
                    ]),
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
                Action::make('edit_result')
                    ->label('Sửa kết quả khám')
                    ->icon('heroicon-o-pencil-square')
                    ->visible(fn($record) => $record->status === 'completed')
                    ->form([
                        RichEditor::make('result')
                            ->label('Kết quả khám')
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('medication')
                            ->label('Thông tin thuốc (không bắt buộc)'),
                        FileUpload::make('files')
                            ->label('Tệp đính kèm kết quả')
                            ->multiple()
                            ->downloadable()
                            ->previewable(true)
                            ->openable()
                            ->directory('exam-results')
                            ->disk('public'),
                    ])
                    ->mountUsing(function (Form $form, Appointment $record) {
                        $form->fill([
                            'result' => optional($record->examResult)->result,
                            'medication' => optional($record->examResult)->medication,
                            'files' => optional(optional($record->examResult)->files)->pluck('path')->toArray() ?? [],
                        ]);
                    })
                    ->action(function (array $data, Appointment $record): void {
                        DB::transaction(function () use ($data, $record) {
                            $examResult = $record->examResult()->updateOrCreate([], [
                                'result' => $data['result'],
                                'medication' => $data['medication'] ?? null,
                            ]);

                            $newPaths = $data['files'] ?? [];
                            $existingPaths = $examResult->files()->pluck('path')->toArray();

                            $toDelete = array_diff($existingPaths, $newPaths);
                            $toAdd = array_diff($newPaths, $existingPaths);

                            if (!empty($toDelete)) {
                                $examResult->files()
                                    ->whereIn('path', $toDelete)
                                    ->get()
                                    ->each(function (AppFile $file) {
                                        Storage::disk($file->disk)->delete($file->path);
                                        $file->delete();
                                    });
                            }

                            foreach ($toAdd as $path) {
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
                    ->modalHeading('Chỉnh sửa kết quả khám')
                    ->modalSubmitActionLabel('Lưu thay đổi'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
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
            'index' => ListAppointmentHistories::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('doctor_profile_id', Auth::user()->doctorProfile->id)
            ->where('status', 'completed')
            ->with([
                'patient',
                'patient.user',
                'service',
                'bill',
                'examResult',
                'examResult.files',
                'files',
            ])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }
}
