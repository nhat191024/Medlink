<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language $language
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLanguage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserLanguage whereUserId($value)
 * @mixin \Eloquent
 */
class UserLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'language_id',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
