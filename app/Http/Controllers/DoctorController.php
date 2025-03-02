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
            $data->user_id = auth()->id(); // Ensure the logged-in user owns the data
        } else {
            $data = Doctor::where('user_id', auth()->id())->findOrFail($v->id);
        }

        $data->name = $v->name;

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
        if (empty($v->q)) {
            $data = Doctor::where('user_id', auth()->id())
                ->select(['DoctorID', 'name'])
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $data = Doctor::where('user_id', auth()->id())
                ->where('name', 'like', '%' . $v->q . '%')
                ->orderBy('name', 'asc')
                ->get();
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        // Ensure users can only delete their own records
        $data = Doctor::where('user_id', auth()->id())->findOrFail($id);
        $data->delete();

        return response()->json(['success' => 'Product deleted successfully.']);
    }
}
