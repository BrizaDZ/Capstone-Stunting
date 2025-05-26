<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\LokasiPuskesmas as Lokasi;
use DataTables;
use DB;
use Auth;

class LokasiPuskesmasController extends Controller
{
    public function index()
    {
        return view('admin.master.puskesmas.index');
    }

    public function Add()
    {
        return view('admin.master.puskesmas.addedit', ['data' => new Lokasi]);
    }

    public function Edit($id)
    {
        return view('admin.master.puskesmas.addedit', ['data' => Lokasi::findOrFail($id)]);
    }

    public function store(Request $v)
    {
        if ($v->id == 0) {
            $data = new Lokasi;
        } else {
            $data = Lokasi::findOrFail($v->id);
        }

        $data->nama = $v->nama;
        $data->alamat = $v->alamat;
        $data->kabupaten = $v->kabupaten;
        $data->kecamatan = $v->kecamatan;
        $data->kelurahan = $v->kelurahan;
        $data->longitude = $v->longitude;
        $data->latitude = $v->latitude;

        $data->save();

        return ['success' => true];

    }


    public function Ajax(Request $request)
    {
        $data = Lokasi::select([
            'nama',
            'alamat',
            'Kabupaten',
            'Kecamatan',
            'Kelurahan',
            'longitude',
            'latitude',
            'PuskesmasID',

        ]);
        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

    public function search(Request $v)
    {
        if (empty($v->q)) {
            $data = Lokasi::select(['PuskesmasID', 'nama', 'user_id'])->orderBy('nama', 'asc')->get();
        } else {
            $data = Lokasi::select(['PuskesmasID', 'nama', 'user_id'])
                        ->where('nama', 'like', '%' . $v->q . '%')
                        ->orderBy('nama', 'asc')
                        ->get();
        }

        return response()->json($data);
    }


    public function delete($id)
    {
        Lokasi::find($id)->delete();

        return response()->json(['success' => 'Product deleted successfully.']);
    }
}
