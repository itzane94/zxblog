<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function edit(){
        $formData = Input::only(['name','email','password','gravatar','autograph','description']);
        $validator = validator::make($formData,[
            'name'=>'required|min:6|max:16',
            'email'=>'required|email',
            'gravatar'=>'required|max:200',
            'autograph'=>'required|max:200'
        ]);
        if($validator->passes()){
            $admin = DB::table('admins')->where('id','=',Auth::guard('admin')->user()->id);
            $update = [
                "name"=>$formData['name'],
                "email"=>$formData['email'],
                "gravatar"=>$formData['gravatar'],
                "autograph"=>$formData['autograph'],
                "description"=>$formData['description']
            ];
            if($formData['password']){
                $update['password'] = bcrypt($formData['password']);
            }
            if($admin->update($update)){
                return response()->json([
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'status'=>'fail'
                ]);
            }
        }else{
            $errors = $validator->errors();
            return response()->json($errors);
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return Redirect::route('admin_login');
    }
    public function adminInfo(){
        return view('dashboard.info');
    }
    public function about(){
        $admin = DB::table('admins')->find(1);
        return view('user/about')->with(['active'=>4,'admin'=>$admin]);
    }
   public function echo_square(){
        return view('user/echo');
    }
}
