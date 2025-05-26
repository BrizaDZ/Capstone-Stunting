<?php

namespace App\Http\Controllers;

use App\Exports\StuntingDataExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class StuntingExportController extends Controller
{
    public function export()
    {
        return Excel::download(new StuntingDataExport, 'stunting_data.xlsx');
    }
}
    