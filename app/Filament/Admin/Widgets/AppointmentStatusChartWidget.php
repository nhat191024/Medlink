<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Appointment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class AppointmentStatusChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Phân bố trạng thái lịch hẹn';

    protected static ?int $sort = 5;

    protected function getData(): array
    {
        return Cache::remember('appointment_status_chart_data', 300, function () {
            // Tối ưu hóa bằng cách query một lần duy nhất với groupBy
            $statusCounts = Appointment::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status');

            $pending = $statusCounts->get('pending', 0);
            $confirmed = $statusCounts->get('confirmed', 0);
            $completed = $statusCounts->get('completed', 0);
            $cancelled = $statusCounts->get('cancelled', 0);

            return [
                'datasets' => [
                    [
                        'label' => 'Số lượng',
                        'data' => [$pending, $confirmed, $completed, $cancelled],
                        'backgroundColor' => [
                            'rgba(234, 179, 8, 0.8)',   // pending - yellow
                            'rgba(59, 130, 246, 0.8)',  // confirmed - blue
                            'rgba(34, 197, 94, 0.8)',   // completed - green
                            'rgba(239, 68, 68, 0.8)',   // cancelled - red
                        ],
                        'borderColor' => [
                            'rgb(234, 179, 8)',
                            'rgb(59, 130, 246)',
                            'rgb(34, 197, 94)',
                            'rgb(239, 68, 68)',
                        ],
                        'borderWidth' => 1,
                    ],
                ],
                'labels' => ['Chờ xác nhận', 'Đã xác nhận', 'Hoàn thành', 'Đã hủy'],
            ];
        });
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
        ];
    }
}
