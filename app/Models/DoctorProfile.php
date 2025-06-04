<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'id_card_path',
        'medical_degree_path',
        'professional_card_path',
        'exploitation_license_path',
        'professional_number',
        'introduce',
        'medical_category_id',
        'office_address',
        'company_name',
    ];

    /**
     *  Models relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicalCategory()
    {
        return $this->belongsTo(MedicalCategory::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'doctor_profile_id');
    }

    public function workSchedules()
    {
        return $this->hasMany(WorkSchedule::class, 'doctor_profile_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_profile_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'doctor_profile_id');
    }
}
