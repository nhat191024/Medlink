<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $appointment_id
 * @property float $taxVAT
 * @property float $total
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Appointment $appointment
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereTaxVAT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'payment_method',
        'taxVAT',
        'total',
        'status',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
