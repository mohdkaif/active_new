<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
    	$data['view'] = 'front.home';
    	return view('front.index',$data);
    }
    public function event(Request $request)
    {
    	$data['view'] = 'front.event';
    	return view('front.index',$data);
    }
    public function about(Request $request)
    {
    	$data['view'] = 'front.about';
    	return view('front.index',$data);
    }
}
