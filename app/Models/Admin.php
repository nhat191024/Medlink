<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Filament\Panel;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\FilamentUser;

class Admin extends Authenticatable implements FilamentUser, HasAvatar
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'password',
        'email',
        'avatar',
        'role',
        'hospital_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($admin) {
            if (empty($admin->avatar) && !empty($admin->username)) {
                $name = urlencode($admin->username);
                $admin->avatar = "https://ui-avatars.com/api/?name={$name}&background=random&size=512";
            }

            if ($admin->role != 'admin' && $admin->hospital_id == null) {
                $admin->hospital_id = auth()->guard('hospital')->user()->id;
            }
            $admin->save();
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->getRole() === 'admin',
            'hr' => $this->getRole() === 'hr',
            'supervisor' => $this->getRole() === 'supervisor',
            default => false,
        };
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->avatar) {
            return asset($this->avatar);
        }

        return null;
    }

    /**
     * Get the role of the admin.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the hospital associated with the admin.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
