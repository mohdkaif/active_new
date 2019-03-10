<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Validations\Validate as Validations;
use Illuminate\Http\Request;
use App\Models\State;
class FrontController extends Controller
{
    public function __construct(Request $request)
    {   
        parent::__construct($request);
    }

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

    public function register(Request $request)
    {
        $data['view']='front.signup';
        return view('front.index',$data);
    }
    public function getUserFrom(Request $request)
    {
        $state = State::get();
        //$city = City::
        if($request->id=='provider'){
            return response()->json([
                'status'    => true,
                'html'      => view("front.template.provider-form",['state'=>$state])->render()
            ]);
        }else{
            return response()->json([
            'status'    => true,
            'html'      => view("front.template.user-form",['state'=>$state])->render()
            ]);
        }
        
    }

    public function SignUp(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->signup();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $this->status   = true;
                $this->alert    = true;

                $this->message = "Login Successful";
                $this->modal = true;
                $this->redirect = url('user/account');
            
            
        }
        return $this->populateresponse();
    }
    public function addMoreChild(Request $request)
    {
            return response()->json([
            'status'    => true,
            'html'      => view("front.template.add-child")->render()
            ]);
    }
}
