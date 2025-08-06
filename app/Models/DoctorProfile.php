<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $id_card_path
 * @property string|null $medical_degree_path
 * @property string|null $professional_card_path
 * @property string|null $exploitation_license_path
 * @property string|null $professional_number
 * @property string|null $introduce
 * @property int|null $medical_category_id
 * @property string|null $office_address
 * @property string|null $company_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Appointment> $appointments
 * @property-read int|null $appointments_count
 * @property-read float|null $average_rating
 * @property-read \App\Models\Hospital $hospital
 * @property-read \App\Models\MedicalCategory|null $medicalCategory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkSchedule> $workSchedules
 * @property-read int|null $work_schedules_count
 * @method static \Database\Factories\DoctorProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereExploitationLicensePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereIdCardPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereIntroduce($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereMedicalCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereMedicalDegreePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereOfficeAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereProfessionalCardPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereProfessionalNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DoctorProfile whereUserId($value)
 * @mixin \Eloquent
 */
class DoctorProfile extends Model
{
    use HasFactory, LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    /**
     * Get the average rating (rate) from related reviews.
     *
     * @return float|null
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rate');
    }

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
