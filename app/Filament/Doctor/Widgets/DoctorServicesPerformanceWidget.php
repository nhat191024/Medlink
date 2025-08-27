<?php

namespace App\Filament\Doctor\Widgets;

use App\Models\Service;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DoctorServicesPerformanceWidget extends BaseWidget
{
    protected static ?string $heading = 'Hiệu suất dịch vụ';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $doctorId = Auth::user()->doctorProfile->id;

        return $table
            ->query(
                Service::query()
                    ->select([
                        'services.*',
                        DB::raw('COUNT(appointments.id) as total_appointments'),
                        DB::raw('COUNT(CASE WHEN appointments.status = "completed" THEN 1 END) as completed_appointments'),
                        DB::raw('SUM(CASE WHEN bills.status = "paid" THEN bills.total ELSE 0 END) as total_revenue')
                    ])
                    ->leftJoin('appointments', 'services.id', '=', 'appointments.service_id')
                    ->leftJoin('bills', 'appointments.id', '=', 'bills.appointment_id')
                    ->where('services.doctor_profile_id', $doctorId)
                    ->groupBy('services.id', 'services.name', 'services.description', 'services.price', 'services.duration', 'services.is_active', 'services.doctor_profile_id', 'services.created_at', 'services.updated_at')
                    ->orderBy('total_appointments', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên dịch vụ')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Giá')
                    ->money('VND')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Thời gian')
                    ->formatStateUsing(fn($state) => $state . ' phút')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Hoạt động')
                    ->boolean(),

                Tables\Columns\TextColumn::make('total_appointments')
                    ->label('Tổng lịch hẹn')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn($state) => number_format($state)),

                Tables\Columns\TextColumn::make('completed_appointments')
                    ->label('Đã hoàn thành')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn($state) => number_format($state)),

                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Doanh thu')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.') . ' ₫'),
            ])
            ->paginated(false);
    }
}
