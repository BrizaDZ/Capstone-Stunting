<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\Article;
use DataTables;
use DB;
use Auth;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.data.article.index');
    }

    public function Add()
    {
        return view('admin.data.article.addedit', ['data' => new Article]);
    }

    public function Edit($id)
    {
        return view('admin.data.article.addedit', ['data' => Article::findOrFail($id)]);
    }

    public function store(Request $v)
    {
        if ($v->ArticleID == 0) {
            $data = new Article;
        } else {
            $data = Article::findOrFail($v->ArticleID);
        }

        $data->ArticleID = $v->ArticleID;
        $data->title = $v->title;
        $data->description = $v->description;
        $data->date = $v->date;


        if ($file = $v->file('photo')) {
            \File::delete('images/article/' . $v->hidden_file2);
            $filename = time() . "_article." . $file->getClientOriginalExtension();
            $file->move(public_path('images/article/'), $filename);
            $data->photo = $filename;
        }
        $data->save();

        return ['success' => true];

    }


    public function Ajax(Request $request)
    {
        $data = Article::select([
            'name',
            'email',
            'role_id',
            'id',
        ]);
        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

}
