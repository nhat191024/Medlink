<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
