<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Filament\Panel;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\FilamentUser;

/**
 *
 *
 * @property string $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $ward
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $website
 * @property string|null $logo
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $contract_start_date
 * @property \Illuminate\Support\Carbon|null $contract_end_date
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Admin> $admins
 * @property-read int|null $admins_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DoctorProfile> $doctors
 * @property-read int|null $doctors_count
 * @property-read string|null $logo_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereContractEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereContractStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereWard($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hospital whereWebsite($value)
 * @mixin \Eloquent
 */
class Hospital extends Authenticatable implements FilamentUser, HasAvatar
{
    use SoftDeletes, LogsActivity, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'password',
        'address',
        'city',
        'ward',
        'email',
        'phone',
        'website',
        'logo',
        'description',
        'doctor_count',
        'contract_start_date',
        'contract_end_date',
        'status'
    ];

    protected $casts = [
        'contract_start_date' => 'date',
        'contract_end_date' => 'date'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();
        //automatically generate a default password if not provided
        static::creating(function ($hospital) {
            if (empty($hospital->password)) {
                $hospital->password = bcrypt('Password1$'); // Default password
            }
        });

        // Automatically soft delete associated admins & doctor profiles when a hospital is deleted
        static::deleting(function ($hospital) {
            $hospital->admins()->each(function ($admin) {
                $admin->delete();
            });

            $hospital->doctors()->each(function ($doctor) {
                $doctor->delete();
            });
        });

        //auto remove soft delete associated admin & doctor profile when a hospital is restored
        static::restoring(function ($hospital) {
            $hospital->admins()->each(function ($admin) {
                $admin->restore();
            });

            $hospital->doctors()->each(function ($doctor) {
                $doctor->restore();
            });
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->logo) {
            return asset($this->logo);
        }

        return null;
    }


    /**
     * Get the activity log options for the model.
     *
     * @return \Spatie\Activitylog\LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    /**
     * Get the logo URL for the hospital.
     *
     * @return string|null
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset($this->logo) : null;
    }

    /**
     * Get the admins associated with the hospital.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admins()
    {
        return $this->hasMany(Admin::class, 'hospital_id');
    }

    /**
     * Get the doctors associated with the hospital.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctors()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the appointments associated with the hospital.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the bills associated with the hospital.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
