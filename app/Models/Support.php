<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $appointment_id
 * @property string $message
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Support whereUserId($value)
 * @mixin \Eloquent
 */
class Support extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'appointment_id', 'message', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
