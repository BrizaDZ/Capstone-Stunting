<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'Doctor';

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
