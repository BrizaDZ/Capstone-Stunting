<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\DoctorOperationalTime;
use Barryvdh\DomPDF\Facade\Pdf;
use DataTables;
use DB;
use Auth;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        if (!Patient::where('user_id', auth()->id())->exists()) {
            if ($request->ajax()) {
                return response()->json(['success' => false]);
            }
        }
        return view('web.appointment', ['data' => new Appointment]);
    }

    public function store(Request $v)
    {

        $existingAppointment = Appointment::where('PatientID', $v->PatientID)
        ->where('DoctorOperationalTimeID', $v->DoctorOperationalTimeID)
        ->first();
        if ($existingAppointment) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah pernah membuat janji temu pada waktu ini.'
            ]);
        }
        $operationalTime = DoctorOperationalTime::findOrFail($v->DoctorOperationalTimeID);

        $currentAppointmentCount = Appointment::where('DoctorOperationalTimeID', $v->DoctorOperationalTimeID)
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

        $data->DoctorOperationalTimeID = $v->DoctorOperationalTimeID;
        $data->appointment_date = $v->appointment_date;
        $data->DoctorID = $v->DoctorID;
        $data->PatientID = $v->PatientID;
        $data->PuskesmasID = $v->PuskesmasID;
        $data->doctor_name = $v->doctor_name;
        $data->patient_name = $v->patient_name;
        $data->status = 'Sedang Berlangsung';
        $data->save();

        $queue_number = $currentAppointmentCount + 1;

        return response()->json([
            'success' => true,
            'appointment_id' => $data->AppointmentID,
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
        $data = Appointment::join('lokasipuskesmas', 'appointment.PuskesmasID', '=', 'lokasipuskesmas.PuskesmasID')
        ->join('doctoroperationaltime', 'appointment.DoctorOperationalTimeID', '=', 'doctoroperationaltime.DoctorOperationalTimeID')
            ->where('appointment.user_id', auth()->id())
            ->select([
                'appointment.patient_name',
                'appointment.doctor_name',
                'appointment.PatientID',
                'appointment.PuskesmasID',
                'appointment.DoctorOperationalTimeID',
                'appointment.status',
                'appointment.AppointmentID',
                'lokasipuskesmas.nama as puskesmas_name',
                'doctoroperationaltime.date',
            ]);

        return Datatables::of($data)
            ->addIndexColumn()
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


}
