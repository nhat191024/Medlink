<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $doctor_profile_id
 * @property string $day_of_week
 * @property string|null $start_time
 * @property string|null $end_time
 * @property int $all_day
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WorkScheduleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule whereAllDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule whereDoctorProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkSchedule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WorkSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_profile_id',
        'day_of_week',
        'start_time',
        'end_time',
        'all_day',
    ];

    public static function isAvailable($doctorProfileId)
    {
        if (Appointment::isDoctorBusy($doctorProfileId)) {
            return false;
        }

        $now = Carbon::now();
        $currentDayOfWeek = $now->format('l');
        $currentTime = $now->format('H:i:s');

        $schedule = self::where('doctor_profile_id', $doctorProfileId)
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
