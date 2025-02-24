<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\User;
use DataTables;
use DB;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.data.user.index');
    }

    public function Add()
    {
        return view('admin.data.user.addedit', ['data' => new User]);
    }

    public function Edit($id)
    {
        return view('admin.data.user.addedit', ['data' => User::findOrFail($id)]);
    }

    public function store(Request $v)
    {
        if ($v->id == 0) {
            $data = new User;
        } else {
            $data = User::findOrFail($v->id);
        }

        $data->name = $v->name;
        $data->email = $v->email;
        $data->role_id = $v->role_id;

        $data->save();

        return ['success' => true];

    }


    public function Ajax(Request $request)
    {
        $data = User::select([
            'name',
            'email',
            'role_id',
            'id',
        ]);
        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

}
