<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Validator;
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
        }else{
            $query->orderBy('id','desc');
        }
        $count = $query->count();
        return response()->json([
          'rows'=> $query->with('type')->offset($formData['start'])->limit($formData['pagesize'])->get()->toArray(),
          'total'=>$count
        ]);
    }
    public function delete(){
        $dels = Input::only('dels');
        if($dels){
                $count = DB::table('articles')->whereIn('id',$dels)->delete();
                if($count){
                    return response()->json(['status'=>200,'msg'=>$count]);
                }else{
                    return response()->json(['status'=>201,'msg'=>'failed']);
                }
        }else{
            return response()->json([
                'status'=>200,
                'msg'=>'success'
            ]);
        }
    }
    public function add(Request $request){
        if($request->isMethod('post')){
            $formData = Input::only(['title','type_id','display','content','cover']);
            $validator = validator::make($formData,[
                'title'=>'required|max:100',
                'type_id'=>'required|integer',
                'display'=>'required|boolean',
                'cover'=>'required|max:100'
            ]);
            if(!$validator->passes()){
                $errors = $validator->errors();
                return response()->json($errors);
            }
            $art = new Article();
            $art->title = $formData['title'];
            $art->type_id = $formData['type_id'];
            $art->display = $formData['display'];
            $art->content = $formData['content'];
            $art->cover = $formData['cover'];
            $art->user_id = Auth::guard('admin')->user()->id;
            if($art->save()){
                return response()->json([
                    'status'=>200,
                    'msg'=>'success'
                ]);
            }else{
                return response()->json([
                    'msg'=>'failed'
                ]);
            }
        }else{
            $types = Type::all()->toArray();
            $types = $this->getTree($types);
            return view('article/add')->with('types',$types);
        }
    }
    public function edit(Article $article,Request $request){
        if($request->isMethod('post')){
            $formData = Input::only(['title','type_id','display','content','cover']);
            $validator = validator::make($formData,[
                'title'=>'required|max:100',
                'type_id'=>'required|integer',
                'display'=>'required|boolean',
                'cover'=>'required|max:100'
            ]);
            if(!$validator->passes()){
                $errors = $validator->errors();
                return response()->json($errors);
            }
            $article->title = $formData['title'];
            $article->type_id = $formData['type_id'];
            $article->display = $formData['display'];
            $article->content = $formData['content'];
            $article->cover = $formData['cover'];
            $article->user_id = Auth::guard('admin')->user()->id;
            if($article->save()){
                return response()->json([
                    'status'=>200,
                    'msg'=>'success'
                ]);
            }else{
                return response()->json([
                    'msg'=>'failed'
                ]);
            }
        }else{
            $types = Type::all()->toArray();
            $types = $this->getTree($types);
            return view('article/edit')->with(['article'=>$article,'types'=>$types]);
        }
    }
    private function getTree($list, $pid=0, $level=0)
    {
        static $newlist = array();
        foreach($list as $key => $value)
        {
            if($value['pid']==$pid)
            {
                $value['level'] = $level;
                $newlist[] = $value;
                unset($list[$key]);
                $this->getTree($list, $value['id'], $level+1);
            }
        }
        return $newlist;
    }
    public function blog(){
        return view('article/blog')->with(['active'=>2]);
    }
    public function archive(){
        return view('article/archive')->with(['active'=>3]);
    }
}
