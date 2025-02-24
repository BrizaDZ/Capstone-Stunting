<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationalTime extends Model
{
    use HasFactory;
    protected $table = 'OperationalTime';

    protected $primaryKey = 'OperationalTimeID';

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_operational_times');
    }
}
