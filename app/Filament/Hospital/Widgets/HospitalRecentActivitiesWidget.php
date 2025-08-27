<?php

namespace App\Filament\Hospital\Widgets;

use App\Models\Appointment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class HospitalRecentActivitiesWidget extends BaseWidget
{
    protected static ?string $heading = 'Hoạt động gần đây';

    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $hospitalId = Auth::user()->id;

        return $table
            ->query(
                Appointment::query()
                    ->with([
                        'patient.user:id,name,email', // Select only needed fields
                        'doctor.user:id,name,email',
                        'patient:id,user_id',
                        'doctor:id,user_id',
                        'service:id,name'
                    ])
                    ->whereHas('doctor.user', function ($query) use ($hospitalId) {
                        $query->where('hospital_id', $hospitalId);
                    })
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

                Tables\Columns\TextColumn::make('service.name')
                    ->label('Dịch vụ')
                    ->limit(30),

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
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Chờ xác nhận',
                        'confirmed' => 'Đã xác nhận',
                        'completed' => 'Hoàn thành',
                        'cancelled' => 'Đã hủy',
                        'rejected' => 'Bị từ chối',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Được tạo')
                    ->since()
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
