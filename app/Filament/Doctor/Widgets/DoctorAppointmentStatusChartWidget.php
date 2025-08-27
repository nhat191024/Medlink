<?php

namespace App\Filament\Doctor\Widgets;

use App\Models\Appointment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class DoctorAppointmentStatusChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Phân bố trạng thái lịch hẹn';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $doctorId = Auth::user()->doctorProfile->id;

        return Cache::remember("doctor_appointment_status_chart_{$doctorId}", 300, function () use ($doctorId) {
            // Tối ưu hóa bằng cách query một lần duy nhất với groupBy
            $statusCounts = Appointment::selectRaw('status, COUNT(*) as count')
                ->where('doctor_profile_id', $doctorId)
                ->groupBy('status')
                ->pluck('count', 'status');

            $pending = $statusCounts->get('pending', 0);
            $confirmed = $statusCounts->get('confirmed', 0);
            $completed = $statusCounts->get('completed', 0);
            $cancelled = $statusCounts->get('cancelled', 0);
            $rejected = $statusCounts->get('rejected', 0);

            return [
                'datasets' => [
                    [
                        'label' => 'Số lượng',
                        'data' => [$pending, $confirmed, $completed, $cancelled, $rejected],
                        'backgroundColor' => [
                            'rgba(234, 179, 8, 0.8)',   // pending - yellow
                            'rgba(59, 130, 246, 0.8)',  // confirmed - blue
                            'rgba(34, 197, 94, 0.8)',   // completed - green
                            'rgba(239, 68, 68, 0.8)',   // cancelled - red
                            'rgba(220, 38, 38, 0.8)',   // rejected - dark red
                        ],
                        'borderColor' => [
                            'rgb(234, 179, 8)',
                            'rgb(59, 130, 246)',
                            'rgb(34, 197, 94)',
                            'rgb(239, 68, 68)',
                            'rgb(220, 38, 38)',
                        ],
                        'borderWidth' => 1,
                    ],
                ],
                'labels' => ['Chờ xác nhận', 'Đã xác nhận', 'Hoàn thành', 'Đã hủy', 'Bị từ chối'],
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
