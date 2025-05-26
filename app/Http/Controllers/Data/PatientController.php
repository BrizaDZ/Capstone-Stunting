<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\Patient;
use DataTables;
use DB;
use Auth;

class PatientController extends Controller
{
    public function index()
    {
        return view('puskesmas.data.pasient.index');
    }

    public function Add()
    {
        return view('puskesmas.data.pasient.addedit', ['data' => new Patient]);
    }

    public function Edit($id)
    {
        return view('puskesmas.data.pasient.addedit', ['data' => Patient::findOrFail($id)]);
    }

    public function Ajax(Request $request)
    {
        $data = Patient::select([
                'name',
                'age',
                'gender',
                'kabupaten',
                'kecamatan',
                'kelurahan',
                'PatientID',
        ]);
        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

    public function store(Request $v)
    {
        if ($v->id == 0) {
            $data = new Patient;
        } else {
            $data = Patient::findOrFail($v->id);
        }

        $data->nik = $v->nik;

        $data->name = $v->name;
        $data->age = $v->age;

        $data->gender = $v->gender;
        $data->kabupaten = $v->kabupaten;

        $data->kelurahan = $v->kelurahan;
        $data->kecamatan = $v->kecamatan;

        $data->rt = $v->rt;
        $data->rw = $v->rw;

        $data->alamat = $v->alamat;
        $data->RelationshipID = $v->RelationshipID;

        $data->save();

        return ['success' => true];

    }

}
