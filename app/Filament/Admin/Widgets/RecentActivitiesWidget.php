<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Appointment;
use App\Models\PatientProfile;
use App\Models\DoctorProfile;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentActivitiesWidget extends BaseWidget
{
    protected static ?string $heading = 'Hoạt động gần đây';

    protected static ?int $sort = 7;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Appointment::query()
                    ->with([
                        'patient.user:id,name,email',
                        'doctor.user:id,name,email',
                        'patient:id,user_id',
                        'doctor:id,user_id'
                    ])
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('patient.user.name')
                    ->label('Bệnh nhân')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('doctor.user.name')
                    ->label('Bác sĩ')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Ngày hẹn')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('time')
                    ->label('Giờ hẹn'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Chờ xác nhận',
                        'confirmed' => 'Đã xác nhận',
                        'completed' => 'Hoàn thành',
                        'cancelled' => 'Đã hủy',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Đặt lúc')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(false);
    }
}
