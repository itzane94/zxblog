<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('get')){
            return view('user/login');
        }else{
            $formData = Input::only(['name','password','captcha']);
            $validator = validator::make($formData,[
                'name'=>'required|min:6|max:16',
                'password'=>'required|min:6|max:20',
                'captcha'=>'required|captcha'
            ]);
            if($validator->passes()){
                $result = Auth::guard('admin')->attempt(['name'=>$formData['name'],'password'=>$formData['password']]);
                if($result){
                    return response()->json([
                        'status'=>'200',
                        'code'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'code'=>'fail'
                    ]);
                }
            }else{
                $errors = $validator->errors();
                return response()->json($errors);
            }
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return Redirect::route('admin_login');
    }


}
