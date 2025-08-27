<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Bill;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class RevenueChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Doanh thu 12 tháng qua';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        return Cache::remember('revenue_chart_data', 300, function () {
            // Tối ưu hóa bằng cách query một lần duy nhất
            $startMonth = Carbon::now()->subMonths(11)->startOfMonth();
            $endMonth = Carbon::now()->endOfMonth();

            $revenues = Bill::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as total_revenue')
                ->whereBetween('created_at', [$startMonth, $endMonth])
                ->where('status', 'paid')
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
                            'rgba(34, 197, 94, 0.8)',
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(234, 179, 8, 0.8)',
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(168, 85, 247, 0.8)',
                            'rgba(236, 72, 153, 0.8)',
                            'rgba(34, 197, 94, 0.8)',
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(234, 179, 8, 0.8)',
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(168, 85, 247, 0.8)',
                            'rgba(236, 72, 153, 0.8)',
                        ],
                        'borderColor' => [
                            'rgb(34, 197, 94)',
                            'rgb(59, 130, 246)',
                            'rgb(234, 179, 8)',
                            'rgb(239, 68, 68)',
                            'rgb(168, 85, 247)',
                            'rgb(236, 72, 153)',
                            'rgb(34, 197, 94)',
                            'rgb(59, 130, 246)',
                            'rgb(234, 179, 8)',
                            'rgb(239, 68, 68)',
                            'rgb(168, 85, 247)',
                            'rgb(236, 72, 153)',
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
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return new Intl.NumberFormat("vi-VN").format(value) + " VNĐ"; }',
                    ],
                ],
            ],
        ];
    }
}
