<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $reason
 * @property float $amount
 * @property string $type
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TransactionHistory whereUserId($value)
 * @mixin \Eloquent
 */
class TransactionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reason',
        'amount',
        'type',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
