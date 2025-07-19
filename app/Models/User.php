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

use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;

/**
 *
 *
 * @property int $id
 * @property string $user_type
 * @property string $identity
 * @property string $email
 * @property string $password
 * @property string|null $avatar
 * @property string|null $name
 * @property string|null $gender
 * @property string|null $country_code
 * @property string|null $phone
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $country
 * @property string|null $city
 * @property string|null $state
 * @property string|null $address
 * @property string|null $zip_code
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $last_login
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DoctorProfile|null $doctorProfile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Favorite> $favoriteDoctors
 * @property-read int|null $favorite_doctors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Favorite> $favoritePatients
 * @property-read int|null $favorite_patients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserLanguage> $languages
 * @property-read int|null $languages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notification
 * @property-read int|null $notification_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PatientProfile|null $patientProfile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserSetting> $setting
 * @property-read int|null $setting_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Support> $support
 * @property-read int|null $support_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TransactionHistory> $transactionHistory
 * @property-read int|null $transaction_history_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdentity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereZipCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable implements FilamentUser, HasAvatar, Wallet
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes, HasWallet;

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
        'gender',
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

    public function doctorProfile()
    {
        return $this->hasOne(DoctorProfile::class, 'user_id');
    }

    public function languages()
    {
        return $this->hasMany(UserLanguage::class);
    }

    /**
     * Get the user's preferred locale
     */
    public function getPreferredLocale()
    {
        $firstLanguage = $this->languages()->with('language')->first();
        return $firstLanguage ? $firstLanguage->language->code : config('app.locale');
    }

    public function settings()
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
