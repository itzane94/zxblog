<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Article;
class HomepageController extends Controller
{
    //
    public function index(){
        $articles = Article::with('type')->orderBy('created_at','desc')->limit(7)->get()->toArray();
        return view('home/homepage')->with(['active'=>1,'articles'=>$articles]);
    }
}
