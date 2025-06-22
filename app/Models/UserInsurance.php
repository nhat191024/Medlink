<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $patient_profile_id
 * @property string|null $insurance_type
 * @property string|null $insurance_number
 * @property string|null $registry
 * @property string|null $registered_address
 * @property string|null $valid_from
 * @property string|null $main_insured
 * @property string|null $entitled_insured
 * @property string|null $assurance_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserInsuranceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereAssuranceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereEntitledInsured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereInsuranceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereInsuranceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereMainInsured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance wherePatientProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereRegisteredAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereRegistry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserInsurance whereValidFrom($value)
 * @mixin \Eloquent
 */
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
