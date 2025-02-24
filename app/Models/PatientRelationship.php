<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRelationship extends Model
{
    use HasFactory;
    protected $table = 'PatientRelationship';

    protected $primaryKey = 'RelationshipID';
}
