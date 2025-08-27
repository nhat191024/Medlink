<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 *
 *
 * @property int $id
 * @property int $patient_id
 * @property int|null $doctor_id
 * @property int|null $appointment_id
 * @property string $message
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereUserId($value)
 * @mixin \Eloquent
 */
class Support extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['patient_id', 'doctor_id', 'appointment_id', 'hospital_id', 'message', 'status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function patient()
    {
        return $this->belongsTo(PatientProfile::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(DoctorProfile::class, 'doctor_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
