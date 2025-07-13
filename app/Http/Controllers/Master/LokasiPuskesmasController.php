<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\LokasiPuskesmas as Lokasi;
use App\Models\User;
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
        $data = DB::table('lokasipuskesmas')
            ->join('users', 'lokasipuskesmas.PuskesmasID', '=', 'users.id')
            ->where('users.id', $id)
            ->select('lokasipuskesmas.*', 'users.name as user_name', 'users.id as user_id')
            ->first();

        if (!$data) {
            $user = DB::table('users')->where('id', $id)->first();

            $data = (object)[
                'LokasiPuskesmasID' => 0,
                'nama' => '',
                'alamat' => '',
                'kabupaten' => '',
                'kecamatan' => '',
                'kelurahan' => '',
                'longitude' => '',
                'latitude' => '',
                'PuskesmasID' => $user->id,
                'user_name' => $user->name,
                'user_id' => $user->id,
            ];
        }

        return view('admin.master.puskesmas.addedit', ['data' => $data]);
    }

    public function store(Request $v)
    {
        if ($v->lokasiid == 0) {
            $data = new Lokasi;
        } else {
        $data = Lokasi::findOrFail($v->lokasiid);
        }

        $data->nama = $v->nama;
        $data->alamat = $v->alamat;
        $data->kabupaten = $v->kabupaten;
        $data->kecamatan = $v->kecamatan;
        $data->kelurahan = $v->kelurahan;
        $data->longitude = $v->longitude;
        $data->latitude = $v->latitude;
        $data->PuskesmasID = $v->id;

        $data->save();

        return ['success' => true];

    }


    public function Ajax(Request $request)
    {
        $data = User::where('role_id', '3')
        ->select([
            'name',
            'id',
            'email',
            'telp',

        ]);
        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

    public function search(Request $v)
    {
        if (empty($v->q)) {
            $data = Lokasi::select(['LokasiPuskesmasID', 'nama', 'PuskesmasID'])->orderBy('nama', 'asc')->get();
        } else {
            $data = Lokasi::select(['LokasiPuskesmasID', 'nama', 'PuskesmasID'])
                        ->where('nama', 'like', '%' . $v->q . '%')
                        ->orderBy('nama', 'asc')
                        ->get();
        }

        return response()->json($data);
    }


    public function delete($id)
    {
        try {
            $lokasi = Lokasi::findOrFail($id); // pastikan data ada
            $lokasi->delete();

            return response()->json(['success' => true, 'message' => 'Data lokasi Puskesmas berhasil dihapus.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.'], 500);
        }
    }

}
