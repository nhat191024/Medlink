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
use Bavix\Wallet\Traits\CanConfirm;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Interfaces\Confirmable;
use BeyondCode\QueryDetector\Outputs\Log;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log as FacadesLog;

/**
 *
 *
 * @property int $id
 * @property string $user_type
 * @property string $identity
 * @property int|null $hospital_id
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
 * @property string|null $ward
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
 * @property-read non-empty-string $balance
 * @property-read int $balance_int
 * @property-read \Bavix\Wallet\Models\Wallet $wallet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserLanguage> $languages
 * @property-read int|null $languages_count
 * @property-read int|null $notification_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PatientProfile|null $patientProfile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Bavix\Wallet\Models\Transfer> $receivedTransfers
 * @property-read int|null $received_transfers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserSetting> $settings
 * @property-read int|null $settings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Support> $support
 * @property-read int|null $support_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Bavix\Wallet\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Bavix\Wallet\Models\Transfer> $transfers
 * @property-read int|null $transfers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Bavix\Wallet\Models\Transaction> $walletTransactions
 * @property-read int|null $wallet_transactions_count
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGender($value)
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
class User extends Authenticatable implements Wallet, Confirmable, FilamentUser, HasAvatar
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes, HasWallet, CanConfirm, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type',
        'identity',

        'hospital_id',

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
        'ward',
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

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            if (empty($user->avatar)) {
                $name = urlencode($user->name);
                $user->avatar = "https://ui-avatars.com/api/?name={$name}&background=random&size=512";
            }
        });

        // Automatically soft delete associated doctor profile or patient profile when a user is deleted
        static::deleting(function ($user) {
            if ($user->doctorProfile) {
                $user->doctorProfile()->delete();
            }
            if ($user->patientProfile) {
                $user->patientProfile()->delete();
            }
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->identity === 'doctor' && $panel->getId() === 'doctor') {
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }


    /**
     * Get the user's preferred locale
     */
    public function getPreferredLocale()
    {
        $firstLanguage = $this->languages()->with('language')->first();
        return $firstLanguage ? $firstLanguage->language->code : config('app.locale');
    }

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

    public function hospital()
    {
        return $this->belongsTo(Hospital::class)->withTrashed();
    }

    public function languages()
    {
        return $this->hasMany(UserLanguage::class);
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

    public function patientSupport()
    {
        return $this->hasMany(Support::class, 'patient_id');
    }

    public function doctorSupport()
    {
        return $this->hasMany(Support::class, 'doctor_id');
    }
}
