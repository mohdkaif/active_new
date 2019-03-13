<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Validations\Validate as Validations;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\User;
use App\Models\UserChild;
use Auth;
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
                $data['user_type'] = $request->type;
                $data['first_name'] = $request->first_name;
                $data['last_name'] = $request->last_name;
                $data['mobile'] = $request->mobile;
                $data['otp'] = $request->otp;
                $data['email'] = $request->email;
                $data['address'] = $request->address;
                $data['country'] = $request->region;
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

            $this->message = "SignUp Successful";
            $this->modal = true;
            $this->redirect = url('login');
        }
        return $this->populateresponse();
    }
    public function addMoreChild(Request $request)
    {
        $count = (!empty($request->count)?$request->count:'');
        return response()->json([
        'status'    => true,
        'count'     => $count,
        'html'      => view("front.template.add-child",compact('count'))->render()
        ]);
    }

    public function login(Request $request)
    {
        $data['view']='front.login';
        return view('front.index',$data);
    }
    public function auth(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->login();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            if(is_numeric($request->username)){
                $login = \Auth::attempt(['mobile' => $request->username,'password' => $request->password]);
            }else{
                $login = \Auth::attempt(['email' => $request->username,'password' => $request->password]);
            }
            if ($login){
                $this->status   = true;
                $this->alert    = true;
                $this->message  = "Login Successful";
                $this->modal    = true;
                $this->redirect = url('user/profile');
            }else{
                $this->message = $validator->errors()->add('password', 'Username or Password is invalid');
            }
        }
        return $this->populateresponse();
    }

    public function forgotPassword(Request $request)
    {
        $data['view']='front.forgotpass';
        return view('front.index',$data);
    }

    public function sendForgotOTp(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->forgotpass();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            
                $user = Auth::user(); 
                $autopass = strtoupper(str_random(8));
               $data['otp']=$autopass;
            if(!is_numeric($request->username)){

                $user = User::where('email', '=', $request->username)->firstOrFail();
                $input['otp'] = $autopass;
                $upd = $user->update($input);
                $subject = "Reset Password Request";
                $msg = "Your OTP is : ".$autopass;
                $emailData               = ___email_settings();
                $emailData['name']       = $user->name; //!empty($request->name)?$request->name:'';
                $emailData['email']      = !empty($user->email)?$user->email:'';
                $emailData['subject']    = 'Reset Password Request';
                $emailData['password']    = !empty($autopass)?$autopass:'';
                $emailData['date']       = date('Y-m-d H:i:s');

                $emailData['custom_text'] = 'Your Enquiry has been submitted successfully';
                $mailSuccess = ___mail_sender($emailData['email'],$user->name,"forgot_password",$emailData);
               
       
                $this->status   = true;
                $this->alert    = true;
                $this->message  = "Forgot OTP send  Successful";
                $this->modal    = true;
                $this->redirect = url('change-password?user='.___encrypt($user->id));
            }else{
                $user = User::where(['mobile' => $request->username])->first();
                $upd = User::where(['mobile' => $request->username])->update($data);
                $apiKey = urlencode('Af8JoCyMRKc-3KCSW0EBcsbim6Y7FVTtg6SD1bOvfC');
                // Message details
                $phone_code=91;
                $numbers = array($phone_code.$user->mobile);
                $sender = urlencode('TXTLCL');
                $message = rawurlencode('Active Bachha Mobile verification OTP is '.$autopass);
                $numbers = implode(',', $numbers);
                $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
                $ch = curl_init('https://api.textlocal.in/send/');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $this->status   = true;
                $this->alert    = true;
                $this->message  = "Forgot OTP send  Successful";
                $this->modal    = true;
                $this->redirect = url('change-password?user='.___encrypt($user->id));
            }
        }
        return $this->populateresponse();
    }

    public function newPassword(Request $request)
    {
        $data['id']=$request->user;
        $data['view']='front.newpassword';
        return view('front.index',$data);
    }

    public function changePassword(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->changePassword();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $id = ___decrypt($request->id);
            $data['password']=\Hash::make($request->password);
            $user = User::where('id', '=', $id)->update($data);
            $this->status   = true;
            $this->alert    = true;
            $this->message  = "Password Change Successfully.";
            $this->modal    = true;
            $this->redirect = url('login');
        }
        return $this->populateresponse();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
