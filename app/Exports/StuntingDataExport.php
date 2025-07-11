<?php

namespace App\Exports;

use App\Models\LokasiPuskesmas;
use App\Models\Stunting;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StuntingDataExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil PuskesmasID berdasarkan user yang login
        $puskesmasId = LokasiPuskesmas::where('PuskesmasID', Auth::id())->value('PuskesmasID');

        // Query data stunting yang sesuai dengan PuskesmasID
        return Stunting::join('patient', 'stunting.PatientID', '=', 'patient.PatientID')
            ->where('stunting.PuskesmasID', $puskesmasId)
            ->select([
                'patient.name',
                'stunting.age',
                'stunting.gender',
                'stunting.weight',
                'stunting.height',
                'stunting.measuretype',
                'stunting.zscoreweightage',
                'stunting.zscoreheightage',
                'stunting.zscoreweightheight',
                'stunting.weightage',
                'stunting.heightage',
                'stunting.weightheight',
                'stunting.status',
            ])
            ->get();
    }

    public function headings(): array
    {
        return [
            'Patient Name',
            'Age',
            'Gender',
            'Weight',
            'Height',
            'Measure Type',
            'Z-Score Weight-Age',
            'Z-Score Height-Age',
            'Z-Score Weight-Height',
            'Weight-Age',
            'Height-Age',
            'Weight-Height',
            'Status'
        ];
    }
}
