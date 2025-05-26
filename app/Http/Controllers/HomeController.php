<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Doctor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->take(3)->get();
        $doctors=Doctor::join('users', 'doctor.user_id', '=', 'users.id')
        ->select([
            'doctor.*',
            'users.name as namapuskesmas',
        ])->get();
        return view('web.home', compact('articles', 'doctors'));
    }
}
