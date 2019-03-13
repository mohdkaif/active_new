<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserProfileController extends Controller
{
    public function profile(Request $request)
    {
    	$data['view']='front.profile';
    	return view('front.index',$data);
    }
}
