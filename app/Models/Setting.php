<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'email',
        'address',
        'phone',

        'app_url',
        'play_store_url',

        'doctor_approved',

        'main_banner',
        'favicon',
        'logo',
    ];
}
