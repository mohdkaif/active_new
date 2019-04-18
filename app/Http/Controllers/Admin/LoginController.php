<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
    	return view('admin.login');
    }

    public function validateLogin(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'password' => 'required|min:6|max:15',
        ]);
        $user = false;

        $validator->after(function ($validator) use (&$user, $request) {
            $user = User::where('email', $request->email)->where('user_type','=','admin')->orWhere('user_type','=','subadmin')->where('status','<>','deleted')->first();
            if (!$user) {
                $validator->errors()->add('error', 'Your Account does not exists.');
            } elseif ($user->user_type == 'user') {
                $validator->errors()->add('role', 'You are not a Authorized Person.');
            } elseif ($user->status == 'deleted') {
                $validator->errors()->add('delete', 'Your account doesnot exist.');
            } elseif (!\Hash::check($request->password, $user->password)) {
            // dd($user);
                $validator->errors()->add('password', 'Invalid credentials.');
            } elseif ($user->status == 'inactive') {
                $validator->errors()->add('password', 'Your account has been blocked. To re-activate your account please contact to admin.');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            \Auth::login($user);
            return redirect()->intended('admin/dashboard');
        }
    }

    public function logout(Request $request){
    	\Auth::logout();
    	return redirect()->intended('admin/login');
    }

    public function dashboard(Request $request)
    {
    	$data['view'] = 'admin.dashboard';
    	return view('admin.index',$data);
    }
}
