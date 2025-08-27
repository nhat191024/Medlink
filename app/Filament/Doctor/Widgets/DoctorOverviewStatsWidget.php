<?php

namespace App\Filament\Doctor\Widgets;

use App\Models\Bill;
use App\Models\Appointment;
use App\Models\Review;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class DoctorOverviewStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $doctorId = Auth::user()->doctorProfile->id;

        return Cache::remember("doctor_overview_stats_{$doctorId}", 300, function () use ($doctorId) {
            // Tổng số lịch hẹn của bác sĩ
            $totalAppointments = Appointment::where('doctor_profile_id', $doctorId)->count();

            // Lịch hẹn hôm nay
            $todayAppointments = Appointment::where('doctor_profile_id', $doctorId)
                ->where('date', today())
                ->count();

            // Lịch hẹn đã hoàn thành
            $completedAppointments = Appointment::where('doctor_profile_id', $doctorId)
                ->where('status', 'completed')
                ->count();

            // Lịch hẹn chờ xác nhận
            $pendingAppointments = Appointment::where('doctor_profile_id', $doctorId)
                ->where('status', 'pending')
                ->count();

            // Doanh thu tháng này
            $monthlyRevenue = Bill::whereHas('appointment', function ($query) use ($doctorId) {
                $query->where('doctor_profile_id', $doctorId);
            })
                ->whereMonth('created_at', now()->month)
                ->where('status', 'paid')
                ->sum('total');

            // Đánh giá trung bình
            $avgRating = Review::where('doctor_profile_id', $doctorId)->avg('rate');
            $totalReviews = Review::where('doctor_profile_id', $doctorId)->count();

            // Số dịch vụ đang hoạt động
            $activeServices = Service::where('doctor_profile_id', $doctorId)
                ->where('is_active', true)
                ->count();

            return [
                Stat::make('Tổng lịch hẹn', number_format($totalAppointments))
                    ->description('Tất cả lịch hẹn')
                    ->descriptionIcon('heroicon-m-calendar')
                    ->color('primary'),

                Stat::make('Lịch hẹn hôm nay', $todayAppointments)
                    ->description('Lịch hẹn trong ngày')
                    ->descriptionIcon('heroicon-m-calendar-days')
                    ->color('info'),

                Stat::make('Đã hoàn thành', number_format($completedAppointments))
                    ->description('Lịch hẹn hoàn thành')
                    ->descriptionIcon('heroicon-m-check-circle')
                    ->color('success'),

                Stat::make('Chờ xác nhận', $pendingAppointments)
                    ->description('Cần xử lý')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color('warning'),

                Stat::make('Doanh thu tháng', number_format($monthlyRevenue, 0, ',', '.') . ' VNĐ')
                    ->description('Doanh thu tháng hiện tại')
                    ->descriptionIcon('heroicon-m-currency-dollar')
                    ->color('success'),

                Stat::make('Đánh giá', $avgRating ? number_format($avgRating, 1) . '/5' : 'Chưa có')
                    ->description($totalReviews . ' lượt đánh giá')
                    ->descriptionIcon('heroicon-m-star')
                    ->color($avgRating >= 4.5 ? 'success' : ($avgRating >= 4 ? 'warning' : 'danger')),

                Stat::make('Dịch vụ', $activeServices)
                    ->description('Dịch vụ đang hoạt động')
                    ->descriptionIcon('heroicon-m-squares-plus')
                    ->color('info'),
            ];
        });
    }
}
