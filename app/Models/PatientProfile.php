<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'birth_date',
        'age',
        'gender',
        'height',
        'weight',
        'blood_group',
        'medical_history',
    ];

    /**
     *  Models relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function insurance()
    {
        return $this->hasOne(UserInsurance::class, 'patient_profile_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_profile_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'patient_profile_id');
    }
}
