<?php

namespace App\Filament\Hospital\Widgets;

use App\Models\Appointment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class HospitalAppointmentStatusChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Phân bố trạng thái lịch hẹn';

    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $hospitalId = Auth::user()->id;

        return Cache::remember("hospital_appointment_status_chart_{$hospitalId}", 300, function () use ($hospitalId) {
            // Tối ưu hóa bằng cách query một lần duy nhất với groupBy
            $statusCounts = Appointment::selectRaw('status, COUNT(*) as count')
                ->whereHas('doctor.user', function ($query) use ($hospitalId) {
                    $query->where('hospital_id', $hospitalId);
                })
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
                            'rgba(249, 115, 22, 0.8)',  // confirmed - orange
                            'rgba(34, 197, 94, 0.8)',   // completed - green
                            'rgba(239, 68, 68, 0.8)',   // cancelled - red
                        ],
                        'borderColor' => [
                            'rgb(234, 179, 8)',
                            'rgb(249, 115, 22)',
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
