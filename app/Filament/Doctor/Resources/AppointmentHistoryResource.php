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
                // Action::make('view_bill')
                //     ->label('Xem hóa đơn')
                //     ->icon('heroicon-o-document-text')
                //     ->color('info')
                //     ->url(fn($record) => route('filament.admin.resources.bills.view', $record->bill->id))
                //     ->openUrlInNewTab()
                //     ->visible(fn($record) => $record->bill !== null),
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
                'bill'
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
