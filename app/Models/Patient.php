<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'Patient';
    protected $primaryKey = 'PatientID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $initials = collect(explode(' ', $model->name))
                ->map(function ($word) {
                    return strtoupper(substr($word, 0, 1));
                })
                ->implode('');

            $prefix = 'STUNT-' . $initials;

            $latest = self::where('PatientID', 'like', $prefix . '-%')
                          ->orderBy('PatientID', 'desc')
                          ->first();

            if ($latest) {
                $lastNumber = intval(substr($latest->PatientID, strrpos($latest->PatientID, '-') + 1));
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $model->PatientID = $prefix . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }
}
