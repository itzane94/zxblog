<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
class ArticleController extends Controller
{
    //
    public function index(){
        return view('article.article_list');
    }
    public function list(){
        $formData = Input::get();
        //检查数据合法性
        $query = Article::query();
        if(isset($formData['keyword'])){
            $query->where('title','like',"%{$formData['keyword']}%");
        }
        if(isset($formData['ordername'])){
            $query->orderBy('created_at',$formData['sortorder']);
        }
        $count = $query->count();
        return response()->json([
          'rows'=> $query->with('type')->offset($formData['start'])->limit($formData['pagesize'])->get()->toArray(),
          'total'=>$count
        ]);
    }
}
