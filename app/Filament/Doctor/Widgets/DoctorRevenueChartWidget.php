<?php

namespace App\Filament\Doctor\Widgets;

use App\Models\Bill;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class DoctorRevenueChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Doanh thu 12 tháng qua';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $doctorId = Auth::user()->doctorProfile->id;

        return Cache::remember("doctor_revenue_chart_{$doctorId}", 300, function () use ($doctorId) {
            // Tối ưu hóa bằng cách query một lần duy nhất
            $startMonth = Carbon::now()->subMonths(11)->startOfMonth();
            $endMonth = Carbon::now()->endOfMonth();

            $revenues = Bill::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as total_revenue')
                ->whereBetween('created_at', [$startMonth, $endMonth])
                ->where('status', 'paid')
                ->whereHas('appointment', function ($query) use ($doctorId) {
                    $query->where('doctor_profile_id', $doctorId);
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
                            'rgba(220, 38, 38, 0.8)',
                            'rgba(185, 28, 28, 0.8)',
                            'rgba(153, 27, 27, 0.8)',
                            'rgba(127, 29, 29, 0.8)',
                            'rgba(103, 32, 32, 0.8)',
                            'rgba(220, 38, 38, 0.8)',
                            'rgba(185, 28, 28, 0.8)',
                            'rgba(153, 27, 27, 0.8)',
                            'rgba(127, 29, 29, 0.8)',
                            'rgba(103, 32, 32, 0.8)',
                            'rgba(220, 38, 38, 0.8)',
                            'rgba(185, 28, 28, 0.8)',
                        ],
                        'borderColor' => [
                            'rgb(220, 38, 38)',
                            'rgb(185, 28, 28)',
                            'rgb(153, 27, 27)',
                            'rgb(127, 29, 29)',
                            'rgb(103, 32, 32)',
                            'rgb(220, 38, 38)',
                            'rgb(185, 28, 28)',
                            'rgb(153, 27, 27)',
                            'rgb(127, 29, 29)',
                            'rgb(103, 32, 32)',
                            'rgb(220, 38, 38)',
                            'rgb(185, 28, 28)',
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
