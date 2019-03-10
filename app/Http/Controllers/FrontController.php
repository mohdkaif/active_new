<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Validations\Validate as Validations;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\User;
use App\Models\UserChild;


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
        $state = State::where('country_id','101')->get();
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

    public function cityList(Request $request){
        $cities = City::where('state_id','=',$request->state_id)
                ->orderBy('id','ASC')
                ->where('status','=','active')
                ->get();


        $html = '<option>Please Select City</option> ';
        foreach ($cities as $value) {
            // //if($value['id'] == $request->state_id){
            //     $html .= '<option value="'.$value['id'].'" selected="selected">'.$value['city_name'].'</option> ';
            // } else {
                $html .= '<option value="'.$value['id'].'">'.$value['city_name'].'</option> ';
            //}
        }
       
        return response()->json([
            'html'      => $html,
            'status'    => 1,
            'message'   => ""
        ]);
    }

    public function SignUp(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->signup();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            if($request->type == 'user'){
                $data['user_type'] = \Hash::make($request->type);
                $data['first_name'] = $request->first_name;
                $data['last_name'] = $request->last_name;
                $data['mobile'] = $request->mobile;
                $data['otp'] = $request->otp;
                $data['email'] = $request->email;
                $data['address'] = $request->address;
                $data['region'] = $request->region;
                $data['state'] = $request->state;
                $data['city'] = $request->city;
                $data['password'] = \Hash::make($request->password);
                $data['status'] = 'active';
                $data['email'] = isset($request->email)?$request->email:'';
                $user = User::create($data);
               
                foreach ($request->child_name as $key => $name) {  
                    $child[$key]['name'] = $name;
                }

                foreach ($request->child_age as $key => $age) {
                    $child[$key]['age'] = $age;
                }
                foreach ($request->child_gender as $key => $gender) {
                    $child[$key]['gender'] = $gender;
                }

                foreach ($child as $child_details) {
                    $childData['user_id'] = $user->id;
                    $childData['name'] = $child_details['name'];
                    $childData['age'] = $child_details['age'];
                    $childData['gender'] = $child_details['gender'];
                    $childData['status'] = 'active';
                    $save_child = UserChild::create($childData);
                }


            }else{

                
                
            }
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
