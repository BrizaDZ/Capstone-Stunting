<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\Patient;
use App\Models\User;
use App\Models\Stunting;
use DataTables;
use DB;
use Auth;

class ProfilePatientController extends Controller
{
    public function index()
    {
        $data = User::where('id', auth()->id())->first();
        $data2 = Stunting::join('appointment', 'stunting.AppointmentID', '=', 'appointment.AppointmentID')
        ->where('appointment.user_id', auth()->id())
        ->select([
            'stunting.*',
            'appointment.patient_name',
            'appointment.appointment_date',


        ])
        ->get();
        return view('web.profile.index', compact('data', 'data2'));
    }

    public function Add()
    {
        return view('web.profile.addedit', ['data' => new Patient]);
    }

    // public function Edit($id)
    // {
    //     return view('admin.master.Patient.addedit', ['data' => Patient::findOrFail($id)]);
    // }

    public function storedetail(Request $v)
    {
        $data = User::where('id', auth()->id())->first();

        $data->alamat = $v->alamat;
        $data->latitude = $v->latitude;
        $data->longitude = $v->longitude;
        $data->name = $v->name;

        $data->save();

        return redirect('/profile/patient');

    }

    public function store(Request $v)
    {
        if ($v->id == 0) {
            $data = new Patient;
            $data->user_id = auth()->id();
        } else {
            $data = Patient::where('user_id', auth()->id())->findOrFail($v->id);
        }

        $data->PatientID = $v->PatientID;
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


    public function Ajax(Request $request)
    {
        $data = Patient::where('user_id', auth()->id())
        ->select([
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

    public function Ajax2(Request $request)
    {
        $data = Stunting::join('appointment', 'stunting.AppointmentID', '=', 'appointment.AppointmentID')->where('user_id', auth()->id())
            ->select([
                'appointment.patient_name',
                'stunting.age',
                'stunting.gender',
                'stunting.weight',
                'stunting.height',
                'stunting.measuretype',
                'stunting.zscoreweightage',
                'stunting.zscoreheightage',
                'stunting.zscoreweightheight',
                'stunting.weightage',
                'stunting.heightage',
                'stunting.weightheight',
                'stunting.status',
            ]);

        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

    public function search(Request $v)
    {
        $userId = auth()->id(); // Get the authenticated user's ID

        if (empty($v->q)) {
            $data = Patient::where('user_id', $userId)
                ->select(['PatientID', 'name'])
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $data = Patient::where('user_id', $userId)
                ->where('name', 'like', '%' . $v->q . '%')
                ->orderBy('name', 'asc')
                ->get();
        }

        return response()->json($data);
    }


    public function searchPatient(Request $request)
    {
        $patient = DB::table('patient')->where('PatientID', $request->id)->first();

        if ($patient) {
            return response()->json([
                'success' => true,
                'data' => [
                    'name' => $patient->name,
                    'gender' => $patient->gender,
                ],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pasien tidak ditemukan.',
            ]);
        }
    }


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
