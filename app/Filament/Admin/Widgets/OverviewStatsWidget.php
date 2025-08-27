<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use App\Models\Bill;
use App\Models\Hospital;
use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class OverviewStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Cache các thống kê trong 5 phút để tránh query liên tục
        return Cache::remember('overview_stats', 300, function () {
            return [
                Stat::make('Tổng số bệnh nhân', PatientProfile::count())
                    ->description('Tổng số bệnh nhân đã đăng ký')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('success'),

                Stat::make('Tổng số bác sĩ', DoctorProfile::count())
                    ->description('Tổng số bác sĩ trong hệ thống')
                    ->descriptionIcon('heroicon-m-user-plus')
                    ->color('info'),

                Stat::make('Tổng số bệnh viện', Hospital::count())
                    ->description('Tổng số bệnh viện đối tác')
                    ->descriptionIcon('heroicon-m-building-office-2')
                    ->color('warning'),

                Stat::make('Lịch hẹn hôm nay', Appointment::whereDate('date', today())->count())
                    ->description('Lịch hẹn trong ngày')
                    ->descriptionIcon('heroicon-m-calendar-days')
                    ->color('primary'),

                Stat::make('Doanh thu tháng này', number_format(Bill::whereMonth('created_at', now()->month)->sum('total'), 0, ',', '.') . ' VNĐ')
                    ->description('Tổng doanh thu tháng hiện tại')
                    ->descriptionIcon('heroicon-m-currency-dollar')
                    ->color('success'),

                Stat::make('Lịch hẹn chờ xác nhận', Appointment::where('status', 'pending')->count())
                    ->description('Cần xem xét')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color('danger'),
            ];
        });
    }
}
