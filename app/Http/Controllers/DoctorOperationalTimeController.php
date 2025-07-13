<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\DoctorOperationalTime;
use DataTables;
use DB;
use Auth;

class DoctorOperationalTimeController extends Controller
{
    public function index()
    {
        return view('puskesmas.master.doctoroperationaltime.index');
    }

    public function Add()
    {
        return view('puskesmas.master.doctoroperationaltime.addedit', ['data' => new DoctorOperationalTime]);
    }

    public function Edit($id)
    {
        $data = DB::table('doctoroperationaltime')
        ->join('doctor', 'doctoroperationaltime.DoctorID', '=', 'doctor.DoctorID')
        ->join('operationaltime', 'doctoroperationaltime.OperationalTimeID', '=', 'operationaltime.OperationalTimeID')
        ->select(
            'doctoroperationaltime.*',
            'doctor.name as doctor_name',
            'operationaltime.name as operational_time_name'
        )
        ->where('doctoroperationaltime.DoctorOperationalTimeID', $id)
        ->first();

        return view('puskesmas.master.doctoroperationaltime.addedit', ['data' => $data]);
    }

    public function store(Request $v)
    {
        if ($v->id == 0) {
            $data = new DoctorOperationalTime;
            $data->user_id = auth()->id();
        } else {
            $data = DoctorOperationalTime::where('user_id', auth()->id())->findOrFail($v->id);
        }

        $data->DoctorID = $v->DoctorID;
        $data->OperationalTimeID = $v->OperationalTimeID;
        $data->quota = $v->quota;
        $data->date = $v->date;

        $data->save();

        return ['success' => true];

    }


    public function Ajax(Request $request)
    {
        $data = DoctorOperationalTime::join('doctor', 'doctoroperationaltime.DoctorID', '=', 'doctor.DoctorID')
            ->join('operationaltime', 'doctoroperationaltime.OperationalTimeID', '=', 'operationaltime.OperationalTimeID')
            ->where('doctoroperationaltime.user_id', auth()->id())
            ->select([
                'doctoroperationaltime.*',
                'doctoroperationaltime.DoctorID',
                'doctor.name as doctor_name',
                'operationaltime.name as operational_time_name',
            ]);

        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

    public function search(Request $v)
    {
        $query = DoctorOperationalTime::join('operationaltime', 'doctoroperationaltime.OperationalTimeID', '=', 'operationaltime.OperationalTimeID')
            ->join('doctor', 'doctor.DoctorID', '=', 'doctoroperationaltime.DoctorID')
            ->join('users', 'doctor.user_id', '=', 'users.id')
            ->select([
                'doctoroperationaltime.DoctorOperationalTimeID',
                'doctoroperationaltime.date',
                'doctoroperationaltime.DoctorID',
                'doctor.name as doctor_name',
                'doctor.photo',
                'doctor.user_id',
                'users.name as puskesmas_name',
                'operationaltime.name as shift_name',
            ])
            ->orderBy('doctoroperationaltime.date', 'asc');

        if (!empty($v->term)) {
            $query->where('doctoroperationaltime.date', 'like', '%' . $v->term . '%');
        }

        if (!empty($v->DoctorID)) {
            $query->where('doctoroperationaltime.DoctorID', $v->DoctorID);
        }

        if (!empty($v->appointment_date)) {
            $query->whereDate('doctoroperationaltime.date', '=', $v->appointment_date);
        }

        if (!empty($v->puskesmas_id)) {
            $query->where('doctor.user_id', $v->puskesmas_id);
        }

        $data = $query->get();

        return response()->json($data);
    }




    public function delete($id)
        {
            $data = DoctorOperationalTime::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ]);

        }
}
