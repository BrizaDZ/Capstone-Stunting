<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'Appointment';

    protected $primaryKey = 'AppointmentID';

    public function puskesmas()
    {
        return $this->belongsTo(LokasiPuskesmas::class, 'PuskesmasID');
    }

    public function doctorOperationalTime()
    {
        return $this->belongsTo(DoctorOperationalTime::class, 'DoctorOperationalTimeID');
    }

}


