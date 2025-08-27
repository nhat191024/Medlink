<?php

namespace App\Filament\Hospital\Widgets;

use App\Models\User;
use App\Models\Bill;
use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class HospitalOverviewStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $hospitalId = Auth::user()->id;

        return Cache::remember("hospital_overview_stats_{$hospitalId}", 300, function () use ($hospitalId) {
            // Doctors của bệnh viện này
            $doctorsCount = DoctorProfile::whereHas('user', function ($query) use ($hospitalId) {
                $query->where('hospital_id', $hospitalId)
                    ->where('identity', 'doctor');
            })->count();

            // Lịch hẹn hôm nay của bệnh viện
            $todayAppointments = Appointment::where('date', today())
                ->whereHas('doctor.user', function ($query) use ($hospitalId) {
                    $query->where('hospital_id', $hospitalId);
                })->count();

            // Tổng lịch hẹn của bệnh viện
            $totalAppointments = Appointment::whereHas('doctor.user', function ($query) use ($hospitalId) {
                $query->where('hospital_id', $hospitalId);
            })->count();

            // Doanh thu tháng này của bệnh viện
            $monthlyRevenue = Bill::whereMonth('created_at', now()->month)
                ->whereHas('appointment.doctor.user', function ($query) use ($hospitalId) {
                    $query->where('hospital_id', $hospitalId);
                })
                ->where('status', 'paid')
                ->sum('total');

            // Lịch hẹn chờ xác nhận
            $pendingAppointments = Appointment::where('status', 'pending')
                ->whereHas('doctor.user', function ($query) use ($hospitalId) {
                    $query->where('hospital_id', $hospitalId);
                })->count();

            // Bệnh nhân đã từng khám tại bệnh viện
            $patientsCount = PatientProfile::whereHas('appointments.doctor.user', function ($query) use ($hospitalId) {
                $query->where('hospital_id', $hospitalId);
            })->distinct()->count();

            return [
                Stat::make('Số bác sĩ', $doctorsCount)
                    ->description('Bác sĩ trong bệnh viện')
                    ->descriptionIcon('heroicon-m-user-plus')
                    ->color('info'),

                Stat::make('Bệnh nhân', $patientsCount)
                    ->description('Đã từng khám tại bệnh viện')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('success'),

                Stat::make('Lịch hẹn hôm nay', $todayAppointments)
                    ->description('Lịch hẹn trong ngày')
                    ->descriptionIcon('heroicon-m-calendar-days')
                    ->color('primary'),

                Stat::make('Tổng lịch hẹn', number_format($totalAppointments))
                    ->description('Tất cả lịch hẹn')
                    ->descriptionIcon('heroicon-m-calendar')
                    ->color('warning'),

                Stat::make('Doanh thu tháng', number_format($monthlyRevenue, 0, ',', '.') . ' VNĐ')
                    ->description('Doanh thu tháng hiện tại')
                    ->descriptionIcon('heroicon-m-currency-dollar')
                    ->color('success'),

                Stat::make('Chờ xác nhận', $pendingAppointments)
                    ->description('Lịch hẹn cần xử lý')
                    ->descriptionIcon('heroicon-m-clock')
                    ->color('danger'),
            ];
        });
    }
}
