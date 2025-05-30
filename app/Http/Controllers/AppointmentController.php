<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\Appointment;
use App\Models\DoctorOperationalTime;
use Barryvdh\DomPDF\Facade\Pdf;
use DataTables;
use DB;
use Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('web.appointment', ['data' => new Appointment]);
    }

    public function store(Request $v)
    {
        $doctorOperationalTimeID = $v->DoctorOperationalTimeID;
        $appointmentDate = $v->appointment_date;

        $operationalTime = DoctorOperationalTime::findOrFail($doctorOperationalTimeID);

        $currentAppointmentCount = Appointment::where('DoctorOperationalTimeID', $doctorOperationalTimeID)
            ->where('appointment_date', $appointmentDate)
            ->count();

        if ($currentAppointmentCount >= $operationalTime->quota) {
            return response()->json(['success' => false, 'message' => 'Kuota penuh untuk tanggal ini.']);
        }

        if ($v->id == 0) {
            $data = new Appointment;
            $data->user_id = auth()->id();
        } else {
            $data = Appointment::where('user_id', auth()->id())->findOrFail($v->id);
        }

        $data->DoctorOperationalTimeID = $doctorOperationalTimeID;
        $data->appointment_date = $appointmentDate;
        $data->DoctorID = $v->DoctorID;
        $data->PatientID = $v->PatientID;
        $data->PuskesmasID = $v->PuskesmasID;
        $data->doctor_name = $v->doctor_name;
        $data->patient_name = $v->patient_name;

        $data->save();

        $queue_number = $currentAppointmentCount + 1;

        return response()->json([
            'success' => true,
            'appointment_id' => $data->id,
            'queue_number' => $queue_number,
        ]);
    }

     public function printCard($id)
    {
        $appointment = Appointment::with(['doctorOperationalTime', 'puskesmas'])->findOrFail($id);

        $queue_number = Appointment::where('DoctorOperationalTimeID', $appointment->DoctorOperationalTimeID)
        ->where('appointment_date', $appointment->appointment_date)
        ->where('AppointmentID', '<=', $appointment->AppointmentID)
        ->count();


        return Pdf::loadView('web.queue_card', [
            'appointment' => $appointment,
            'queue_number' => $queue_number
        ])->download('kartu-antrean.pdf');
    }



    public function Ajax(Request $request)
    {
        $data = Appointment::with(['puskesmas', 'doctorOperationalTime'])
            ->where('user_id', auth()->id())
            ->select([
                'patient_name',
                'doctor_name',
                'PatientID',
                'PuskesmasID',
                'DoctorOperationalTimeID',
                'status',
                'AppointmentID',
            ]);

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('puskesmas', function ($row) {
                return $row->puskesmas ? $row->puskesmas->nama : '-';
            })
            ->addColumn('jadwal', function ($row) {
                return $row->doctorOperationalTime ? $row->doctorOperationalTime->day : '-';
            })
            ->make(true);
    }


    public function search(Request $v)
    {
        $userId = auth()->id();

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
