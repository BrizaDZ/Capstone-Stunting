<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperationalTime extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'operationaltime';

    protected $primaryKey = 'OperationalTimeID';

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_operational_times');
    }
}
