<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 *
 *
 * @property int $id
 * @property int $patient_profile_id
 * @property int $doctor_profile_id
 * @property int $service_id
 * @property string $status
 * @property string $medical_problem
 * @property string|null $medical_problem_file
 * @property int $duration
 * @property string $date
 * @property string $day_of_week
 * @property string $time
 * @property string|null $reason
 * @property string|null $link
 * @property string|null $address
 * @property bool $status_job_scheduled
 * @property \Illuminate\Support\Carbon|null $status_job_scheduled_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bill|null $bill
 * @property-read \App\Models\DoctorProfile $doctor
 * @property-read \App\Models\PatientProfile $patient
 * @property-read \App\Models\Review|null $review
 * @property-read \App\Models\Service $service
 * @method static \Database\Factories\AppointmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereDoctorProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereMedicalProblem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereMedicalProblemFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment wherePatientProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereStatusJobScheduled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereStatusJobScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment withoutTrashed()
 * @mixin \Eloquent
 */
class Appointment extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

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
        'status_job_scheduled',
        'status_job_scheduled_at',
    ];

    protected $casts = [
        'status_job_scheduled' => 'boolean',
        'status_job_scheduled_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

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

    public function bill()
    {
        return $this->hasOne(Bill::class, 'appointment_id');
    }

    public static function isDoctorBusy($doctorProfileId)
    {
        $now = Carbon::now();
        $currentDate = $now->format('Y-m-d');
        $currentDayOfWeek = $now->format('l');

        $appointments = self::where('doctor_profile_id', $doctorProfileId)
            ->where('date', $currentDate)
            ->where('day_of_week', $currentDayOfWeek)
            ->whereIn('status', ['pending', 'upcoming'])
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
