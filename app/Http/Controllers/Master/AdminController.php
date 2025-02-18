<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\LokasiPenyimpanan as Lokasi;
use App\Models\JenisLokasi;
use DataTables;
use DB;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.master.puskesmas.index');
    }

    // public function Add()
    // {
    //     return view('admin.master.lokasi.addedit', ['data' => new Lokasi]);
    // }

    // public function Edit($id)
    // {
    //     return view('admin.master.lokasi.addedit', ['data' => Lokasi::findOrFail($id)]);
    // }

    // public function store(Request $v)
    // {
    //     if ($v->id == 0) {
    //         $data = new Lokasi;
    //     } else {
    //         $data = Lokasi::findOrFail($v->id);
    //     }

    //     $data->jenislokasiID = $v->jenislokasiID;
    //     $data->nama_lokasi = $v->nama_lokasi;

    //     $data->KabupatenID = $v->KabupatenID;
    //     $data->KecamatanID = $v->KecamatanID;

    //     $data->KelurahanID = $v->KelurahanID;
    //     $data->rw = $v->rw;

    //     $data->rt = $v->rt;
    //     $data->alamat = $v->alamat;

    //     $data->Latitude = $v->Latitude;
    //     $data->Longitude = $v->Longitude;

    //     $data->NamaKabupaten = $v->NamaKabupaten;
    //     $data->NamaKecamatan = $v->NamaKecamatan;
    //     $data->NamaKelurahan = $v->NamaKelurahan;
    //     $data->Hari_Kerja = $v->Hari_Kerja;
    //     $data->Jam_Operasional = $v->Jam_Operasional;
    //     $data->Maps = $v->Maps;

    //     $data->save();

    //     return ['success' => true];

    // }


    // public function Ajax(Request $request)
    // {
    //     $data = Lokasi::select([
    //         'nama_lokasi',
    //         'LokasiID',
    //         'alamat',
    //         'KabupatenID',
    //         'KecamatanID',
    //         'KelurahanID',
    //         'NamaKabupaten',
    //         'NamaKecamatan',
    //         'NamaKelurahan',
    //         'jenislokasiID',
    //         'Hari_Kerja',
    //         'Jam_Operasional',
    //         'Maps'

    //     ])
    //         ->when($request->get('kota') != null, function ($query) use ($request) {
    //             return $query->where('KabupatenID', $request->kota);
    //         }, function ($query) {
    //             return $query;
    //         })
    //         ->when($request->get('kec') != null, function ($query) use ($request) {
    //             return $query->where('KecamatanID', $request->kec);
    //         }, function ($query) {
    //             return $query;
    //         })
    //         ->when($request->get('kel') != null, function ($query) use ($request) {
    //             return $query->where('KelurahanID', $request->kel);
    //         }, function ($query) {
    //             return $query;
    //         })
    //         ->when($request->get('tipe') != null, function ($query) use ($request) {
    //             return $query->where('jenislokasiID', $request->tipe);
    //         }, function ($query) {
    //             return $query;
    //         });
    //     $datatables = Datatables::of($data);

    //     return $datatables->addIndexColumn()->make(true);

    // }

    // public function search(Request $v)
    // {
    //     if (empty($v->q)) {
    //         $data = Lokasi::select(['LokasiID', 'nama_lokasi'])->orderBy('nama_lokasi', 'asc')->get();
    //     } else {
    //         $data = Lokasi::where('nama_lokasi', 'like', '%' . $v->q . '%')->orderBy('nama_lokasi', 'asc')->get();
    //     }

    //     return response()->json($data);
    // }

    // public function searchjenis(Request $v)
    // {
    //     if (empty($v->q)) {
    //         $data = JenisLokasi::select(['jenislokasiID', 'namalokasi'])->orderBy('namalokasi', 'asc')->get();
    //     } else {
    //         $data = JenisLokasi::where('namalokasi', 'like', '%' . $v->q . '%')->orderBy('namalokasi', 'asc')->get();
    //     }

    //     return response()->json($data);
    // }

    // public function delete($id)
    // {
    //     Lokasi::find($id)->delete();

    //     return response()->json(['success' => 'Product deleted successfully.']);
    // }
}
