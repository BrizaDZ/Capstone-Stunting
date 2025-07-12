<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use App\Models\Article;
use Illuminate\Support\Str;
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

    public function Detail($slug)
    {
        $data = Article::where('slug', $slug)->firstOrFail();
        $data->increment('counterview');
        $populars = Article::where('ArticleID', '!=', $data->ArticleID)
        ->orderBy('counterview', 'desc')
        ->take(10)
        ->get();
        return view('web.article', compact('data', 'populars'));
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
        $artikel->description = $request->input('description');
        $data->date = $v->date;
         $data->slug = Str::slug($v->title);


        if ($file = $v->file('photo')) {
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
            'ArticleID',
            'title',
            'date',
        ]);
        $datatables = Datatables::of($data);

        return $datatables->addIndexColumn()->make(true);

    }

}
