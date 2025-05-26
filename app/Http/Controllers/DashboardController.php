<?php
// app/Http/Controllers/MapController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $puskesmasId = $request->get('puskesmas_id') ?? auth()->user()->id; // Default ke user yang login

        $latestStunting = DB::table('stunting as s1')
            ->select('s1.AppointmentID', 's1.status')
            ->join('appointment as a1', 's1.AppointmentID', '=', 'a1.AppointmentID')
            ->whereRaw('s1.created_at = (
                SELECT MAX(s2.created_at)
                FROM stunting s2
                JOIN appointment a2 ON s2.AppointmentID = a2.AppointmentID
                WHERE a2.PatientID = a1.PatientID
            )');

        $patientsQuery = DB::table('appointment')
            ->joinSub($latestStunting, 'latest_stunting', function ($join) {
                $join->on('appointment.AppointmentID', '=', 'latest_stunting.AppointmentID');
            })
            ->join('patient', 'appointment.PatientID', '=', 'patient.PatientID')
            ->join('users', 'patient.user_id', '=', 'users.id')
            ->select(
                'patient.name',
                'patient.age',
                'patient.gender',
                'patient.alamat',
                'users.latitude',
                'users.longitude',
                'latest_stunting.status'
            );

        if ($puskesmasId) {
            $patientsQuery->where('appointment.PuskesmasID', $puskesmasId);
        }

        $patients = $patientsQuery->get();

        $pendingAppointmentsCount = DB::table('appointment')
            ->where('status', '!=', 'Selesai')
            ->when($puskesmasId, function ($query) use ($puskesmasId) {
                return $query->where('PuskesmasID', $puskesmasId);
            })
            ->count();

        $puskesmasList = DB::table('lokasipuskesmas')->select('user_id', 'nama')->get();

        $stuntingPerMonth = DB::table('stunting')
            ->selectRaw('MONTH(stunting.created_at) as month, COUNT(*) as count')
            ->join('appointment', 'stunting.AppointmentID', '=', 'appointment.AppointmentID')
            ->when($puskesmasId, function ($query) use ($puskesmasId) {
                return $query->where('appointment.PuskesmasID', $puskesmasId);
            })
            ->where('stunting.status', '!=', 'Stunting')
            ->groupByRaw('MONTH(stunting.created_at)')
            ->pluck('count', 'month');

        return view('puskesmas.dashboard', compact('patients', 'pendingAppointmentsCount', 'puskesmasList', 'stuntingPerMonth'));
    }

    public function dashboardAdmin(Request $request){
        $totalPuskesmas = DB::table('lokasipuskesmas')->count();
        $totalUser = DB::table('users')->count();
        $totalPasient = DB::table('patient')->count();
        $totalArtikel = DB::table('articles')->count();

        $puskesmasLocations = DB::table('lokasipuskesmas')
            ->leftJoin('appointment', 'lokasipuskesmas.user_id', '=', 'appointment.PuskesmasID')
            ->leftJoin('stunting', 'appointment.AppointmentID', '=', 'stunting.AppointmentID')
            ->select(
                'lokasipuskesmas.nama as name',
                'lokasipuskesmas.latitude',
                'lokasipuskesmas.longitude',
                DB::raw('SUM(CASE WHEN stunting.status = "Stunting" THEN 1 ELSE 0 END) as total_stunting'),
                DB::raw('SUM(CASE WHEN stunting.status != "Stunting" THEN 1 ELSE 0 END) as total_non_stunting')
            )
            ->groupBy('lokasipuskesmas.user_id', 'lokasipuskesmas.nama', 'lokasipuskesmas.latitude', 'lokasipuskesmas.longitude')
            ->get();

            $topStuntingPuskesmas = DB::table('lokasipuskesmas')
            ->leftJoin('appointment', 'lokasipuskesmas.user_id', '=', 'appointment.PuskesmasID')
            ->leftJoin('stunting', 'appointment.AppointmentID', '=', 'stunting.AppointmentID')
            ->select(
                'lokasipuskesmas.nama as name',
                DB::raw('SUM(CASE WHEN stunting.status = "Stunting" THEN 1 ELSE 0 END) as total_stunting')
            )
            ->groupBy('lokasipuskesmas.user_id', 'lokasipuskesmas.nama')
            ->orderByDesc('total_stunting')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('totalPuskesmas', 'totalUser', 'totalPasient', 'totalArtikel', 'puskesmasLocations', 'topStuntingPuskesmas'));
    }
}
