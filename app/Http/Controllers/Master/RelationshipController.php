<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\PatientRelationship;
use DataTables;
use DB;
use Auth;

class RelationshipController extends Controller
{
    public function index()
    {
        return view('admin.master.relationship.index');
    }

    public function Add()
    {
        return view('admin.master.relationship.addedit', ['data' => new PatientRelationship]);
    }

    public function Edit($id)
    {
        return view('admin.master.relationship.addedit', ['data' => PatientRelationship::findOrFail($id)]);
    }

    public function store(Request $v)
    {
        if ($v->id == 0) {
            $data = new PatientRelationship;
        } else {
            $data = PatientRelationship::findOrFail($v->id);
        }

        $data->name = $v->name;
        $data->save();

        return ['success' => true];

    }


    public function Ajax(Request $request)
    {
        $data = PatientRelationship::select([
            'RelationshipID',
            'name',

        ]);
        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

    public function search(Request $v)
    {
        if (empty($v->q)) {
            $data = PatientRelationship::select(['RelationshipID', 'name'])->orderBy('name', 'asc')->get();
        } else {
            $data = PatientRelationship::where('name', 'like', '%' . $v->q . '%')->orderBy('name', 'asc')->get();
        }

        return response()->json($data);
    }

        public function delete($id)
        {
            $relationship = PatientRelationship::findOrFail($id);
            $relationship->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data hubungan pasien berhasil dihapus.'
            ]);

        }
}
