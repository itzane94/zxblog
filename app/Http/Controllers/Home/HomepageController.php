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
        return view('home/homepage')->with(['active'=>1]);
    }
}
