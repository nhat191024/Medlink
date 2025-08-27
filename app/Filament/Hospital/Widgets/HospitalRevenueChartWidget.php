<?php

namespace App\Filament\Hospital\Widgets;

use App\Models\Bill;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class HospitalRevenueChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Doanh thu 12 tháng qua';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $hospitalId = Auth::user()->id;

        return Cache::remember("hospital_revenue_chart_{$hospitalId}", 300, function () use ($hospitalId) {
            // Tối ưu hóa bằng cách query một lần duy nhất
            $startMonth = Carbon::now()->subMonths(11)->startOfMonth();
            $endMonth = Carbon::now()->endOfMonth();

            $revenues = Bill::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as total_revenue')
                ->whereBetween('created_at', [$startMonth, $endMonth])
                ->where('status', 'paid')
                ->whereHas('appointment.doctor.user', function ($query) use ($hospitalId) {
                    $query->where('hospital_id', $hospitalId);
                })
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get()
                ->keyBy(function ($item) {
                    return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                });

            $data = collect();

            // Tạo dữ liệu cho 12 tháng
            for ($i = 11; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $key = $month->format('Y-m');
                $revenue = $revenues->has($key) ? $revenues->get($key)->total_revenue : 0;

                $data->push([
                    'month' => $month->format('m/Y'),
                    'revenue' => $revenue,
                ]);
            }

            return [
                'datasets' => [
                    [
                        'label' => 'Doanh thu (VNĐ)',
                        'data' => $data->pluck('revenue')->toArray(),
                        'backgroundColor' => [
                            'rgba(249, 115, 22, 0.8)',
                            'rgba(234, 88, 12, 0.8)',
                            'rgba(194, 65, 12, 0.8)',
                            'rgba(154, 52, 18, 0.8)',
                            'rgba(124, 45, 18, 0.8)',
                            'rgba(249, 115, 22, 0.8)',
                            'rgba(234, 88, 12, 0.8)',
                            'rgba(194, 65, 12, 0.8)',
                            'rgba(154, 52, 18, 0.8)',
                            'rgba(124, 45, 18, 0.8)',
                            'rgba(249, 115, 22, 0.8)',
                            'rgba(234, 88, 12, 0.8)',
                        ],
                        'borderColor' => [
                            'rgb(249, 115, 22)',
                            'rgb(234, 88, 12)',
                            'rgb(194, 65, 12)',
                            'rgb(154, 52, 18)',
                            'rgb(124, 45, 18)',
                            'rgb(249, 115, 22)',
                            'rgb(234, 88, 12)',
                            'rgb(194, 65, 12)',
                            'rgb(154, 52, 18)',
                            'rgb(124, 45, 18)',
                            'rgb(249, 115, 22)',
                            'rgb(234, 88, 12)',
                        ],
                        'borderWidth' => 1,
                    ],
                ],
                'labels' => $data->pluck('month')->toArray(),
            ];
        });
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return new Intl.NumberFormat("vi-VN").format(value) + " ₫"; }',
                    ],
                ],
            ],
        ];
    }
}
