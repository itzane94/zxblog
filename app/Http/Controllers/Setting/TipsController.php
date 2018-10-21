<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Tips;
use Validator;
class TipsController extends Controller
{
    public function index(){
        return view('setting.pin_board');

    }
    public function tip_json(){
        $tips = Tips::all()->toArray();
        return response()->json($tips);
    }
    public function tip_add(){
        $formData = Input::only(['wisdom','author']);
        $validator = validator::make($formData,[
                'author'=>'required | max:64',
                'wisdom'=>'required | max:512'
            ]);
        if(!$validator->passes()){
            $errors = $validator->errors();
            return response()->json($errors);
        }
        $tip = new Tips();
        $tip->author = $formData['author'];
        $tip->wisdom = $formData['wisdom'];
        if($tip->save()){
            return response()->json([
                'status'=>200,
                'id'=>$tip->id
            ]);
        }else{
            return response()->json([
                'status'=>503
            ]);

        }

    }
    public function tip_save(Tips $tips){
        $formData = Input::only(['wisdom','author']);
        $validator = validator::make($formData,[
            'author'=>'required | max:64',
            'wisdom'=>'required | max:512'
        ]);
        if(!$validator->passes()){
            $errors = $validator->errors();
            return response()->json($errors);
        }
        $tips->author = $formData['author'];
        $tips->wisdom = $formData['wisdom'];
        if($tips->save()){
            return response()->json([
                'status'=>200,
            ]);
        }else{
            return response()->json([
                'status'=>503
            ]);

        }

    }
    public function tip_delete(Tips $tips){
        if($tips->delete())
        {
            return response()->json([
                'status'=>'success'
            ]);
        }else{
            return response()->json([
                'status'=>'fail'
            ]);
        }

    }
}
