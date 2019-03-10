<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
    	return view('admin.login');
    }

    public function dashboard(Request $request)
    {
    	$data['view'] = 'admin.dashboard';
    	return view('admin.index',$data);
    }
}
