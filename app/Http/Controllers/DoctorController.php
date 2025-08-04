<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\Doctor;
use DataTables;
use DB;
use Auth;

class DoctorController extends Controller
{
    public function index()
    {

        return view('puskesmas.master.doctor.index');
    }

    public function Add()
    {
        return view('puskesmas.master.doctor.addedit', ['data' => new Doctor]);
    }

    public function Edit($id)
    {
        $data = Doctor::where('user_id', auth()->id())->findOrFail($id);

        return view('puskesmas.master.doctor.addedit', ['data' => $data]);
    }

    public function store(Request $v)
    {
        if ($v->id == 0) {
            $data = new Doctor;
            $data->user_id = auth()->id();
        } else {
            $data = Doctor::where('user_id', auth()->id())->findOrFail($v->id);
        }

        $data->name = $v->name;
        if ($file = $v->file('photo')) {
            $filename = time() . "_doctor." . $file->getClientOriginalExtension();
            $file->move(public_path('images/doctor/'), $filename);
            $data->photo = $filename;
        }
        $data->save();

        return ['success' => true];

    }


    public function Ajax(Request $request)
    {
        $data = Doctor::where('user_id', auth()->id())
        ->select([
            'DoctorID',
            'name',
        ]);

        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

    public function search(Request $v)
    {
        $query = Doctor::select(['DoctorID', 'name', 'user_id'])
                    ->orderBy('name', 'asc');

        if (!empty($v->term)) {
            $query->where('name', 'like', '%' . $v->term . '%');
        }

        if (!empty($v->user_id)) {
            $query->where('user_id', $v->user_id);
        }

        $data = $query->get();

        return response()->json($data);
    }



    public function delete($id)
        {
            $data = Doctor::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ]);

        }
}
