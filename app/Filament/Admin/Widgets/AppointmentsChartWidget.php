<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Appointment;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class AppointmentsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Lịch hẹn trong 30 ngày qua';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return Cache::remember('appointments_chart_data', 300, function () {
            // Tối ưu hóa bằng cách query một lần duy nhất
            $startDate = Carbon::today()->subDays(29);
            $endDate = Carbon::today();

            $appointments = Appointment::selectRaw('DATE(date) as appointment_date, COUNT(*) as count')
                ->whereBetween('date', [$startDate, $endDate])
                ->groupBy('appointment_date')
                ->orderBy('appointment_date')
                ->pluck('count', 'appointment_date');

            $data = collect();

            // Tạo dữ liệu cho 30 ngày
            for ($i = 29; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $dateStr = $date->format('Y-m-d');
                $count = $appointments->get($dateStr, 0);

                $data->push([
                    'date' => $date->format('d/m'),
                    'appointments' => $count,
                ]);
            }

            return [
                'datasets' => [
                    [
                        'label' => 'Số lịch hẹn',
                        'data' => $data->pluck('appointments')->toArray(),
                        'borderColor' => '#3b82f6',
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'tension' => 0.4,
                    ],
                ],
                'labels' => $data->pluck('date')->toArray(),
            ];
        });
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
