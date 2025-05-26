<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserInsurance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_profile_id',
        'insurance_type',
        'insurance_number',

        'registry',
        'registered_address',
        'valid_from',

        'main_insured',
        'entitled_insured',
        'assurance_type',
    ];
}
