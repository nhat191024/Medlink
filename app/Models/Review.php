<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $doctor_profile_id
 * @property int $patient_profile_id
 * @property int $appointment_id
 * @property string $review
 * @property float $rate
 * @property int $recommend
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Appointment $appointment
 * @property-read \App\Models\PatientProfile $doctor
 * @property-read \App\Models\DoctorProfile $patient
 * @method static \Database\Factories\ReviewFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereDoctorProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review wherePatientProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereRecommend($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_profile_id',
        'patient_profile_id',
        'appointment_id',
        'review',
        'rate',
        'recommend',
    ];

    public function patient()
    {
        return $this->belongsTo(DoctorProfile::class, 'doctor_profile_id');
    }

    public function doctor()
    {
        return $this->belongsTo(PatientProfile::class, 'patient_profile_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
