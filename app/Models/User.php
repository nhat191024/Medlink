<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Filament\Panel;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->user_type === 'admin') {
            return true;
        }
        return false;
    }


    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->avatar) {
            return asset($this->avatar);
        }

        return null;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type',
        'identity',

        'email',
        'password',

        'avatar',
        'name',
        'country_code',
        'phone',

        'latitude',
        'longitude',

        'country',
        'city',
        'state',
        'address',
        'zip_code',

        'status',
        'last_login',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    /**
     *  Models relationships
     */
    public function patientProfile()
    {
        return $this->hasOne(PatientProfile::class, 'user_id');
    }

    public function DoctorProfile()
    {
        return $this->hasOne(DoctorProfile::class, 'user_id');
    }

    public function languages()
    {
        return $this->hasMany(UserLanguage::class);
    }

    public function setting()
    {
        return $this->hasMany(UserSetting::class);
    }

    public function favoriteDoctors()
    {
        return $this->hasMany(Favorite::class, 'patient_id')->where('type', 'doctor');
    }

    public function favoritePatients()
    {
        return $this->hasMany(Favorite::class, 'doctor_id')->where('type', 'patient');
    }

    public function transactionHistory()
    {
        return $this->hasMany(TransactionHistory::class);
    }

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function support()
    {
        return $this->hasMany(Support::class);
    }
}
