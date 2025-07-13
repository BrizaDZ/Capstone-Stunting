<?php
// app/Http/Controllers/MapController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Chat;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $puskesmasId = $request->get('puskesmas_id') ?? auth()->user()->id; // Default ke user yang login


        $pendingAppointmentsCount = DB::table('appointment')
            ->where('status', '!=', 'Selesai')
            ->when($puskesmasId, function ($query) use ($puskesmasId) {
                return $query->where('PuskesmasID', $puskesmasId);
            })
            ->count();

        $puskesmasList = DB::table('lokasipuskesmas')->select('PuskesmasID', 'nama')->get();

        $stuntingPerMonth = DB::table('stunting')
            ->selectRaw('MONTH(stunting.created_at) as month, COUNT(*) as count')
            ->when($puskesmasId, function ($query) use ($puskesmasId) {
                return $query->where('stunting.PuskesmasID', $puskesmasId);
            })
            ->where('stunting.status', 'Stunting')
            ->groupByRaw('MONTH(stunting.created_at)')
            ->pluck('count', 'month');

        $patients = DB::table('stunting as s1')
            ->select(
                's1.PatientID',
                's1.status',
                'patient.name',
                'patient.age',
                'patient.gender',
                'patient.alamat',
                'users.latitude',
                'users.longitude'
            )
            ->join('patient', 's1.PatientID', '=', 'patient.PatientID')
            ->join('users', 'patient.user_id', '=', 'users.id')
            ->whereRaw('s1.created_at = (SELECT MAX(s2.created_at) FROM stunting s2 WHERE s2.PatientID = s1.PatientID)')
            ->when($puskesmasId, function ($query) use ($puskesmasId) {
                return $query->where('s1.PuskesmasID', $puskesmasId);
            })
            ->get();

        return view('puskesmas.dashboard', compact('patients', 'pendingAppointmentsCount', 'puskesmasList', 'stuntingPerMonth'));
    }

    public function dashboardAdmin(Request $request){
        $totalPuskesmas = DB::table('lokasipuskesmas')->count();
        $totalUser = DB::table('users')->count();
        $totalPasient = DB::table('patient')->count();
        $totalArtikel = DB::table('articles')->count();

        $puskesmasLocations = DB::table('lokasipuskesmas')
            ->leftJoin('stunting', 'lokasipuskesmas.PuskesmasID', '=', 'stunting.PuskesmasID')
            ->select(
                'lokasipuskesmas.nama as name',
                'lokasipuskesmas.latitude',
                'lokasipuskesmas.longitude',
                DB::raw('SUM(CASE WHEN stunting.status = "Stunting" THEN 1 ELSE 0 END) as total_stunting'),
                DB::raw('SUM(CASE WHEN stunting.status != "Stunting" THEN 1 ELSE 0 END) as total_non_stunting')
            )
            ->groupBy('lokasipuskesmas.PuskesmasID', 'lokasipuskesmas.nama', 'lokasipuskesmas.latitude', 'lokasipuskesmas.longitude')
            ->get();

            $topStuntingPuskesmas = DB::table('lokasipuskesmas')
            ->leftJoin('stunting', 'lokasipuskesmas.PuskesmasID', '=', 'stunting.PuskesmasID')
            ->select(
                'lokasipuskesmas.nama as name',
                DB::raw('SUM(CASE WHEN stunting.status = "Stunting" THEN 1 ELSE 0 END) as total_stunting')
            )
            ->groupBy('lokasipuskesmas.PuskesmasID', 'lokasipuskesmas.nama')
            ->orderByDesc('total_stunting')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('totalPuskesmas', 'totalUser', 'totalPasient', 'totalArtikel', 'puskesmasLocations', 'topStuntingPuskesmas'));
    }

    public function getChatByUser($userId)
    {
        $chats = Chat::join('users', 'chat.user_id', '=', 'users.id')
            ->where('user_id', $userId)
            ->orderBy('ChatID', 'asc')
            ->get();

        return response()->json($chats);
    }

    public function getUsersWithChat()
    {
        $users = User::whereIn('id', function ($query) {
            $query->select('user_id')->from('chat')->distinct();
        })->get(['id', 'name']);

        return response()->json($users);
    }


    public function storeChat(Request $v)
    {
        $data = new Chat;

        $data->chat = $v->chat;
        $data->chatby = $v->chatby;
        $data->user_id = $v->user_id;

        $data->save();

        return response()->json($data, 201);
    }

}
