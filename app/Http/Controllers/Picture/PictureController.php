<?php

namespace App\Http\Controllers\Picture;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
class PictureController extends Controller
{
    //
    public function tree(){
        //获取目录下所有文件
        $directory = 'upload';
        //$files = Storage::Files($directory);
        $files = $this->scanfiles($directory);
        $datas = [];
        foreach($files as $dir=>$file){
            $data = [];
            $data['text'] = $dir;
            $children = [];
            foreach($file as $f){
                $tmp['text'] = $f;
                $tmp['icon'] = 'fa fa-file-picture-o';
                array_push($children,$tmp);
            }
            $data['children'] = $children;
            $data = json_encode((object)$data);
            array_push($datas,$data);
        }
        return view('picture/tree')->with('children',$datas);
    }
    public function board(){
        //获取目录下所有文件
        $directory = 'upload';
        $files = $this->scanfiles($directory);
        $datas = [];
        foreach($files as $dir=>$file){
            $data = [];
            $data['text'] = $dir;
            $children = [];
            foreach($file as $f){
                $tmp['text'] = $f;
                $tmp['icon'] = 'fa fa-file-picture-o';
                array_push($children,$tmp);
            }
            $data['children'] = $children;
            $data = json_encode((object)$data);
            array_push($datas,$data);
        }
        return view('picture/board')->with('children',$datas);
    }
    public function upload(Request $request){
//        if(!$request->hasFile('file')){
//            //上传失败
//        }
        $file = $request->file('file');
        if($file->isValid()){ //文件出错
        $res = $file->store(date('Ymd'));
        }

    }
    public function delete(){
        $dir = Input::only('filename');
        $dirArr = explode('/',$dir['filename']);
        unset($dirArr[0]);
        $dir = implode('/',$dirArr);
        if(Storage::delete($dir)){
            return response()->json([
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'status'=>'fail'
            ]);
        }
    }
    function scanfiles($dir) {
        if (! is_dir ( $dir ))
            return array ();

        // 兼容各操作系统
        $dir = rtrim ( str_replace ( '\\', '/', $dir ), '/' ) . '/';

        // 栈，默认值为传入的目录
        $dirs = array ( $dir );

        // 放置所有文件的容器
        //$rt = array ();
        //放置文件及目录
        $frt = array();

        do {
            // 弹栈
            $dir = array_pop ( $dirs );

            // 扫描该目录
            $tmp = scandir ( $dir );

            foreach ( $tmp as $f ) {
                // 过滤. ..
                if ($f == '.' || $f == '..')
                    continue;

                // 组合当前绝对路径
                $path = $dir . $f;


                // 如果是目录，压栈。
                if (is_dir ( $path )) {
                    array_push ( $dirs, $path . '/' );
                   // $frt[$path] = [];
                } else if (is_file ( $path )) { // 如果是文件，放入容器中
                    //$rt [] = $path;
                    $frt[$dir][] = $path;
                }
            }

        } while ( $dirs ); // 直到栈中没有目录

        return $frt;
    }
}
