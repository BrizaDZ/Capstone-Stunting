<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'doctor';

    protected $primaryKey = 'DoctorID';

    public function operationalTimes()
    {
        return $this->belongsToMany(OperationalTime::class, 'doctor_operational_times');
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_operational_times');
    }
}
