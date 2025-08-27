<?php

namespace App\Filament\Admin\Widgets;

use App\Models\PatientProfile;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PatientsGrowthChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Tăng trưởng bệnh nhân mới 6 tháng qua';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        return Cache::remember('patients_growth_chart_data', 300, function () {
            // Tối ưu hóa bằng cách query một lần duy nhất
            $startMonth = Carbon::now()->subMonths(5)->startOfMonth();
            $endMonth = Carbon::now()->endOfMonth();

            $patients = PatientProfile::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
                ->whereBetween('created_at', [$startMonth, $endMonth])
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get()
                ->keyBy(function ($item) {
                    return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                });

            $data = collect();

            // Tạo dữ liệu cho 6 tháng
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $key = $month->format('Y-m');
                $count = $patients->has($key) ? $patients->get($key)->count : 0;

                $data->push([
                    'month' => $month->format('m/Y'),
                    'new_patients' => $count,
                ]);
            }

            return [
                'datasets' => [
                    [
                        'label' => 'Bệnh nhân mới',
                        'data' => $data->pluck('new_patients')->toArray(),
                        'borderColor' => '#10b981',
                        'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                        'tension' => 0.4,
                        'fill' => true,
                    ],
                ],
                'labels' => $data->pluck('month')->toArray(),
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
