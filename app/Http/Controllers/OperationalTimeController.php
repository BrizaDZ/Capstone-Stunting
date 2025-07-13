<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\OperationalTime;
use DataTables;
use DB;
use Auth;

class OperationalTimeController extends Controller
{
    public function index()
    {
        return view('puskesmas.master.operationaltime.index');
    }

    public function Add()
    {
        return view('puskesmas.master.operationaltime.addedit', ['data' => new OperationalTime]);
    }

    public function Edit($id)
    {
        $data = OperationalTime::where('user_id', auth()->id())->findOrFail($id);

        return view('puskesmas.master.operationaltime.addedit', ['data' => $data]);
    }

    public function store(Request $v)
    {
        if ($v->id == 0) {
            $data = new OperationalTime;
            $data->user_id = auth()->id(); // Ensure the logged-in user owns the data
        } else {
            $data = OperationalTime::where('user_id', auth()->id())->findOrFail($v->id);
        }

        $data->name = $v->name;
        $data->time_start = $v->time_start;
        $data->time_end = $v->time_end;

        $data->save();

        return ['success' => true];

    }


    public function Ajax(Request $request)
    {
        $data = OperationalTime::where('user_id', auth()->id())
        ->select([
            'OperationalTimeID',
            'name',
            'time_start',
            'time_end',
        ]);

        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

    public function search(Request $v)
    {
        if (empty($v->q)) {
            $data = OperationalTime::where('user_id', auth()->id())
                ->select(['OperationalTimeID', 'name'])
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $data = OperationalTime::where('user_id', auth()->id())
                ->where('name', 'like', '%' . $v->q . '%')
                ->orderBy('name', 'asc')
                ->get();
        }

        return response()->json($data);
    }

    public function delete($id)
        {
            $data = OperationalTime::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ]);

        }
}
