<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Article;
use App\Tips;
class HomepageController extends Controller
{
    //
    public function index(){
        $articles = Article::with('type')->orderBy('created_at','desc')->limit(7)->get()->toArray();
        $tips = Tips::orderBy('id','desc')->get()->toArray();
        $tip  = array_pop($tips);
        return view('home/homepage')->with(['active'=>1,'articles'=>$articles,'tips'=>$tips,'tip'=>$tip]);
    }
}
