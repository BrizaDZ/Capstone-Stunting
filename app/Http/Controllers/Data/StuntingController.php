<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\Appointment;
use App\Models\Stunting;
use App\Models\LokasiPuskesmas;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DataTables;
use DB;
use Auth;

class StuntingController extends Controller
{
    public function index()
    {
        return view('puskesmas.data.stunting.index');
    }

    public function Detail($id)
    {
        $data = Stunting::join('patient', 'stunting.PatientID', '=', 'patient.PatientID')
            ->where('patient.PatientID', $id)
            ->select([
                'stunting.*',
                'patient.name',
            ])
            ->get();

        return view('puskesmas.data.stunting.detail', compact('data'));
    }

    public function Ajax(Request $request)
    {
        $puskesmasId = LokasiPuskesmas::where('PuskesmasID', auth()->id())->value('PuskesmasID');

        $data = Stunting::join('patient', 'stunting.PatientID', '=', 'patient.PatientID')
            ->where('stunting.PuskesmasID', $puskesmasId)
            ->select([
                'patient.name',
                'patient.PatientID',
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
                'stunting.StuntingID',
                DB::raw('DATE(stunting.created_at) as created_date'),
            ]);

        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);
    }

    public function delete($id)
        {
            $data = Stunting::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ]);

        }
}
