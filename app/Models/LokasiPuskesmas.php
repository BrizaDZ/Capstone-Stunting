<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiPuskesmas extends Model
{
    use HasFactory;
    protected $table = 'LokasiPuskesmas';

    protected $primaryKey = 'PuskesmasID';
}
