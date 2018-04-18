<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Article;
use App\Type;
use App\Tag;
use App\Comment;
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
    public function search_list(){
        $datas = Article::with('type')->with('tags')->orderBy('id','desc')->get();
        $articles = array();
        foreach($datas as $data){
            $tags = [];
            foreach($data->tags as $tag){
                array_push($tags,$tag->name);
            }
            $tmp = [];
            $tmp['id'] = $data['id'];
            $tmp['title'] = $data['title'];
            $tmp['type'] = $data['type']['name'];
            $tmp['tags'] = implode(' ',$tags);
            array_push($articles,$tmp);
        }
        return view('article/search_list')->with(['articles'=>$articles]);
    }
    public function delete(){
        $dels = Input::only('dels');
        $dels = explode(',',$dels['dels']);
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
            $formData = Input::only(['title','type_id','tags_id','display','content','cover']);
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
            if($art->save()){ //文章添加成功
                if($formData['tags_id']){
                    $tags = explode(',',$formData['tags_id']);
                    $art->tags()->attach($tags);
                }
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
            $tags = Tag::all()->toArray();
            return view('article/add')->with(['types'=>$types,'tags'=>$tags]);
        }
    }
    public function edit(Article $article,Request $request){
        if($request->isMethod('post')){
            $formData = Input::only(['title','type_id','tags_id','display','content','cover']);
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
                $tags = explode(',',$formData['tags_id']);
                //dd($tags);die;
                $article->tags()->sync($tags); //自动同步
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
            $tags = Tag::all()->toArray();
            $tags_selected = $article->tags()->select('tag_id')->get();
            $selects = array();
            foreach($tags_selected as $tag)
                array_push($selects,$tag['tag_id']);
            return view('article/edit')->with(['article'=>$article,'types'=>$types,'tags'=>$tags,'selects'=>$selects]);
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
    public function typeTree(){
        $types = Type::all();
        $typeJson = array();
        foreach($types as $type){
            $node = [
                'id'=>'ajson'.$type['id'],
                'parent'=>'ajson'.$type['pid'],
                'text'=>$type['name'],
                'icon'=>'fa fa-file-code-o',
                'state'=>[
                    'opened'=>true
                ]
            ];
            array_push($typeJson,json_encode($node));
        }
        return view('article/type')->with(['typeJson'=>$typeJson]);
    }
    public function type_add(){
        $formData = input::only(['pid','name']);
        $validator = validator::make($formData,[
            'pid'=>'required | integer',
            'name'=>'required | max:20'
        ]);
        if($validator->passes()){
            $type = new Type();
            $type->name = $formData['name'];
            $type->pid = $formData['pid'];
            if($type->save()){
            return response()->json([
                'status'=>'success'
            ]);
            }else{
            return response()->json([
                'status'=>'failed',
            ]);
            }
        }else{
            $errors = $validator->errors();
            return response()->json([
                'status'=>'failed',
                'message'=>$errors
            ]);
        }
    }
    public function type_edit(Type $type){
        $formData = input::only(['name']);
        $validator = validator::make($formData,[
            'name'=>'required | max:20'
        ]);
        if($validator->passes()){
            $type->name = $formData['name'];
            if($type->save()){
                return response()->json([
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'status'=>'failed'
                ]);
            }
        }else{
            $errors = $validator->errors();
            return response()->json([
                'status'=>'failed',
                'message'=>$errors
            ]);
        }
    }
    public function type_delete(Type $type){
        if($type->delete()){
            return response()->json([
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'status'=>'failed'
            ]);
        }
    }
    public function blog(){
        $types = Type::all();
        $tags = Tag::all();
        $additions  = Input::only(['type_id','tag_id']);
        $validator = validator::make($additions,[
            'type_id'=>'required | integer',
            'tag_id'=>'integer | required'
        ]);
        $errors = $validator->errors();
        $conditions = [];
        if(!$errors->has('type_id')){
            $conditions['type_id']=$additions['type_id'];
        }
        $query = Article::with('type');
        if($conditions){
            $query = $query->where($conditions);
        }
        if(!$errors->has('tag_id')){
            $query->whereHas('tags',function($q) use ($additions){
                $q->where('tag_id','=',$additions['tag_id']);
            });
            $conditions['tag_id']=$additions['tag_id'];
        }
        $articles = $query ->orderBy('created_at','desc')->paginate(4);
        $articles->filter = $conditions;
        return view('article/blog')->with(['active'=>2,'articles'=>$articles,'types'=>$types,'tags'=>$tags]);
    }
    public function archive(){
        $articles = Article::orderBy('created_at','desc')->get(['id','title','created_at']);
        return view('article/archive')->with(['active'=>3,'articles'=>$articles]);
    }
    public function archive_json(){
        $articles = Article::orderBy('created_at','desc');
        $count = $articles->count();
        $formData = Input::only(['page','pagesize']);
        $start = ($formData['page']-1)*$formData['pagesize'];
        $articles = $articles->take($formData['pagesize'])->skip($start)->orderBy('created_at','desc')->get(['id','title','created_at'])->toArray();
        foreach($articles as $k=>$article) {
            $articles[$k]['year'] =  date('Y',strtotime($article['created_at']));
            $articles[$k]['month'] =  date('F',strtotime($article['created_at']));
            $articles[$k]['day'] =  'day '.date('d',strtotime($article['created_at'])).'.  ';
            $articles[$k]['hour'] = 'at '.date('H i:s a',strtotime($article['created_at']));
        }
        return response()->json([
            'count'=>$count,
            'articles'=>$articles,
            'pages'=>ceil($count/$formData['pagesize'])
        ]);
    }
    public function detail(Article $article){
        $types = Type::all();
        return view('article/detail')->with(['active'=>2,'article'=>$article,'types'=>$types]);
    }
    public function tag(){
        return view('article/tag');
    }
    public function tag_json(){
        $tags = Tag::all()->toArray();
        return response()->json($tags);
    }
    public function tag_add(){
        $formData = input::only(['name']);
        $validator = validator::make($formData,[
            'name'=>'required | max:20'
        ]);
        if($validator->passes()){
            $tag = new Tag();
            $tag->name = $formData['name'];
            if($tag->save()){
                return response()->json([
                    'status'=>'success',
                    'id'=>$tag->id
                ]);
            }else{
                return response()->json([
                    'status'=>'failed',
                ]);
            }
        }else{
            $errors = $validator->errors();
            return response()->json([
                'status'=>'failed',
                'message'=>$errors
            ]);
        }
    }
    public function tag_edit(Tag $tag){
        $formData = input::only(['name']);
        $validator = validator::make($formData,[
            'name'=>'required | max:20'
        ]);
        if($validator->passes()){
            $tag->name = $formData['name'];
            if($tag->save()){
                return response()->json([
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'status'=>'failed'
                ]);
            }
        }else{
            $errors = $validator->errors();
            return response()->json([
                'status'=>'failed',
                'message'=>$errors
            ]);
        }
    }
    public function tag_delete(Tag $tag){
        if($tag->delete()){
            return response()->json([
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'status'=>'failed'
            ]);
        }
    }
    public function comment_add(){
        $formData = Input::only(['article_id','username','email','site','content']);
        $validator = validator::make($formData,[
            'article_id'=>'required | integer',
            'username'=>'required | max:20',
            'email'=>'required | email',
            'site'=>'max:50',
            'content'=>'required | max:500'
        ]);
        if($validator->passes()){
            $comment = new Comment();
            $comment->article_id = $formData['article_id'];
            $comment->username = $formData['username'];
            $comment->email = $formData['email'];
            $comment->site = $formData['site'];
            $comment->content = $formData['content'];
            if($comment->save()){;
                return response()->json([
                    'status'=>'success',
                ]);
            }else{
                return response()->json([
                    'status'=>'failed'
                ]);
            }
        }else{
            $errors = $validator->errors();
            return response()->json([
                'status'=>'failed',
                'message'=>$errors
            ]);
        }
    }
    public function comment_json(Article $article){
        $article = $article->comments();
        $count = $article->count();
        $formData = Input::only(['page','pagesize']);
        $start = ($formData['page']-1)*$formData['pagesize'];
        $comments = $article->take($formData['pagesize'])->skip($start)->orderBy('created_at','desc')->get(['username','created_at','content','email'])->toArray();
        foreach($comments as $k=>$comment) {
            $comments[$k]['created_at'] =  date('F jS Y',strtotime($comment['created_at']));
        }
        return response()->json([
            'count'=>$count,
            'comments'=>$comments,
            'pages'=>ceil($count/$formData['pagesize'])
        ]);
    }
    public function comment(){
        return view('article.comment_list');
    }
    public function comment_list(){
        $formData = Input::get();
        //检查数据合法性
        $query = Comment::query();
        if(isset($formData['keyword'])){
            $query->where('content','like',"%{$formData['keyword']}%");
        }
        $count = $query->count();
        return response()->json([
            'rows'=> $query->with(['article'=>function($q){
                        $q->select(['id','title']);
                        }])->offset($formData['start'])->limit($formData['pagesize'])->get()->toArray(),
            'total'=>$count
        ]);
    }
    public function comment_delete(){
        $dels = Input::only('dels');
        $dels = explode(',',$dels['dels']);
        if($dels){
            $count = DB::table('comments')->whereIn('id',$dels)->delete();
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
}
