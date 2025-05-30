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
        $doctors = Doctor::where('user_id', auth()->id())->get();
        return view('puskesmas.master.doctoroperationaltime.addedit', ['data' => new DoctorOperationalTime, 'doctors' => $doctors]);
    }

    public function Edit($id)
    {
        $data = DoctorOperationalTime::findOrFail($id);
        $doctors = Doctor::where('user_id', auth()->id())->get();

        return view('puskesmas.master.doctoroperationaltime.addedit', ['data' => $data, 'doctors' => $doctors]);
    }

    public function store(Request $v)
    {
        if ($v->id == 0) {
            $data = new DoctorOperationalTime;
            $data->user_id = auth()->id(); // Ensure the logged-in user owns the data
        } else {
            $data = DoctorOperationalTime::where('user_id', auth()->id())->findOrFail($v->id);
        }

        $data->DoctorID = $v->DoctorID;
        $data->OperationalTimeID = $v->OperationalTimeID;

        $data->save();

        return ['success' => true];

    }


    public function Ajax(Request $request)
    {
        $data = DoctorOperationalTime::join('doctor', 'doctoroperationaltime.DoctorID', '=', 'doctor.DoctorID')->where('user_id', auth()->id())
        ->select([
            'doctoroperationaltime.*',
            'doctoroperationaltime.DoctorID',
            'doctor.name',
        ]);

        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

    public function search(Request $v)
    {
        $query = DoctorOperationalTime::select(['DoctorOperationalTimeID', 'day', 'DoctorID'])
                    ->orderBy('day', 'asc');

        if (!empty($v->term)) {
            $query->where('day', 'like', '%' . $v->term . '%');
        }

        if (!empty($v->DoctorID)) {
            $query->where('DoctorID', $v->DoctorID);
        }

        $data = $query->get();

        return response()->json($data);
    }


    public function delete($id)
    {
        if (Auth::user()->role === 'admin') {
            $data = DoctorOperationalTime::findOrFail($id);
            $data->delete();
            return response()->json(['success' => 'Data deleted successfully.']);
        }
        return response()->json(['error' => 'Unauthorized action.'], 403);
    }
}
