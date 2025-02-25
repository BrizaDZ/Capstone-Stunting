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
        $dataCibatu = DoctorOperationalTime::whereHas('doctor', function ($query) {
            $query->where('user_id', 4);
        })->with(['doctor'])->get();

        $dataCikarang = DoctorOperationalTime::whereHas('doctor', function ($query) {
            $query->where('user_id', 5);
        })->with(['doctor'])->get();

        return view('puskesmas.master.doctoroperationaltime.index', compact('dataCibatu', 'dataCikarang'));
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

        $data->doctor_id = $v->doctor_id;
        $data->operationaltime_id = $v->operationaltime_id;

        $data->save();

        return ['success' => true];

    }


    public function Ajax(Request $request)
    {
        $data = DoctorOperationalTime::where('user_id', auth()->id())
        ->select([
            'DoctorOPerationalTimeID',
            'doctor_id',
            'operationaltime_id',
            'day'
        ]);

        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

    public function search(Request $v)
    {
        $query = DoctorOperationalTime::with('doctor');

        if (!empty($v->q)) {
            $query->whereHas('doctor', function ($query) use ($v) {
                $query->where('name', 'like', '%' . $v->q . '%');
            });
        }

        $data = $query->orderBy('day', 'asc')->get();

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
