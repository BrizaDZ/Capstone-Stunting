<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stunting extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'Stunting';

    protected $primaryKey = 'StuntingID';

}


