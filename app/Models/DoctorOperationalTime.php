<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorOperationalTime extends Model
{
    use HasFactory;
    protected $table = 'DoctorOperationalTime';

    protected $primaryKey = 'DoctorOperationalTimeID';
}
