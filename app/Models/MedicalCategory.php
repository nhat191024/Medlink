<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalCategory withoutTrashed()
 * @mixin \Eloquent
 */
class MedicalCategory extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function doctorProfiles()
    {
        return $this->hasMany(DoctorProfile::class);
    }
}
