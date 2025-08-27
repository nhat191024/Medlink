<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'result',
        'medication',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
