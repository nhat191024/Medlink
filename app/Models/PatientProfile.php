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
 * @property string|null $birth_date
 * @property int|null $age
 * @property int|null $height
 * @property int|null $weight
 * @property string|null $blood_group
 * @property string|null $medical_history
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Appointment> $appointments
 * @property-read int|null $appointments_count
 * @property-read \App\Models\UserInsurance|null $insurance
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PatientProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile whereBloodGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile whereMedicalHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientProfile whereWeight($value)
 * @mixin \Eloquent
 */
class PatientProfile extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'birth_date',
        'age',
        'height',
        'weight',
        'blood_group',
        'medical_history',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    /**
     *  Models relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
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
