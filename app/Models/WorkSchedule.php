<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_profile_id', // ko luu ngay cu the
        'day_of_week', // ngay torng tuan thg day lam viec vao hom nao 2-7
        'start_time',
        'end_time',
        'all_day',
    ];

    public static function isAvailable($doctorId)
    {
        if (Appointment::isDoctorBusy($doctorId)) {
            return false;
        }

        $now = Carbon::now();
        $currentDayOfWeek = $now->format('l');
        $currentTime = $now->format('H:i:s');

        $schedule = self::where('doctor_profile_id', $doctorId)
            ->where('day_of_week', $currentDayOfWeek)
            ->first();

        if (!$schedule) {
            return false;
        }

        if ($schedule->all_day == 1) {
            return true;
        }

        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);

        if ($endTime < $startTime) {
            $endTime->addDay();
            if ($currentTime < '12:00:00') {
                $startTime->subDay();
            }
        }

        return $now->between($startTime, $endTime);
    }
}
