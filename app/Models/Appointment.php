<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_profile_id',
        'doctor_profile_id',
        'service_id',
        'status',
        'medical_problem',
        'medical_problem_file',
        'duration',
        'date',
        'day_of_week',
        'time',
        'reason',
        'link',
        'address',
    ];

    public function patient()
    {
        return $this->belongsTo(PatientProfile::class, 'patient_profile_id');
    }

    public function doctor()
    {
        return $this->belongsTo(DoctorProfile::class, 'doctor_profile_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'appointment_id');
    }

    public static function isDoctorBusy($doctorId)
    {
        $now = Carbon::now();
        $currentDate = $now->format('Y-m-d');
        $currentDayOfWeek = $now->format('l');

        $appointments = self::where('doctor_id', $doctorId)
            ->where('date', $currentDate)
            ->where('day_of_week', $currentDayOfWeek)
            ->whereIn('status', ['2', '3'])
            ->get();

        foreach ($appointments as $appointment) {
            $times = explode(' - ', $appointment->time);
            if (count($times) !== 2) continue;

            $startTime = Carbon::parse("$currentDate {$times[0]}");
            $endTime = Carbon::parse("$currentDate {$times[1]}");

            if ($now->between($startTime, $endTime)) {
                return true;
            }
        }

        return false;
    }
}
