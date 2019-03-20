<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Models\State; 
use App\Models\Country; 
use App\Models\City; 
use App\Models\ProviderUser; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Validations\Validate as Validations;
use Perks\Response;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use TextLocal;
class UserController extends Controller 
{
   /* public function __construct(Request $request){
        parent::__construct($request);
    }*/
   public function __construct(Request $request){
        $this->language         = \App::getLocale();
        $this->prefix           = \DB::getTablePrefix();        
        $this->jsondata         = (object)[];
        $this->message          = "";
        $this->error_code       = "no_error_found";
        $this->status           = false;
        $this->status_code      = 200;
        $this->redirect         = false;
        $this->modal            = false;
        $this->alert            = false;
        $this->next_tab         = false;
        $this->ajax             = 'api';
        $this->successimage     = asset('images/success.png');
        
        if($request->ajax()){
            $this->ajax = 'web';
        }
        $json = json_decode(file_get_contents('php://input'),true);
        if(!empty($json)){
            $this->post = $json;
        }else{
            $this->post = $request->all();
        }
        $request->replace($this->post);
    }
    public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    
    public function login(Request $request)
    {
        if(!empty($request->facebook_id)){
            $CheckUser = User::where('facebook_id',$request->facebook_id)->first();
            if($CheckUser){
                $success['user_details']=$CheckUser;
                $success['token'] =  $CheckUser->createToken('MyApp')->accessToken;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Facebook login Successful";

            }else{
                $success['user_details']='';
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Facebook user not found";
            }
            return $this->populateresponse();

        }

        if(!empty($request->google_id)){
            $CheckUser = User::where('google_id',$request->google_id)->first();
            if($CheckUser){
                $success['user_details']=$CheckUser;
                $success['token'] =  $CheckUser->createToken('MyApp')->accessToken;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Google login Successful";

            }else{
                $success['user_details']='';
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Google user not found";
            }
            return $this->populateresponse();

        }
        $validation = new Validations($request);
        $validator = $validation->login();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            if(is_numeric($request->username)){
                $login = Auth::attempt(['mobile' => $request->username,'password' => $request->password]);
            }else{
                $login = Auth::attempt(['email' => $request->username,'password' => $request->password]);
            }
            if ($login){
                $user = Auth::user(); 
                $success['user_details']=$user;
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Login Successful";
               
            }else{
                $this->message = $validator->errors()->add('not_exist', 'Username or Password is invalid');
            }
        }
        return $this->populateresponse();
    }

    public function forgotPassword(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->forgotpass();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            
                $user = Auth::user(); 
                $autopass = strtoupper(str_random(8));
                $success['user_details']=$user;
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
               
       
                $success['otp'] =  $autopass;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "OTP send Successfully. Please Check your email.";
            }else{
                $data['otp']=$autopass;
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
                $success['otp'] =  $autopass;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Verification OTP send Successfully. Please Check your Register Mobile Number.";
            }
                
               
            
        }
        return $this->populateresponse();
    }

    public function otp(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->otp();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $user = User::where('otp', '=', $request->otp)->firstOrFail();
                if($user){
                    $success['user_details']=$user;
                    $autopass = strtoupper(str_random(4));
                    $input['otp'] = $autopass;
                    $upd = $user->update($input);

                    $this->status   = true;
                    $response = new Response($success);
                    $this->jsondata = $response->api_common_response();
                    $this->message = "Success.";
                }
                
        }
        return $this->populateresponse();
    }

    public function ChangePassword(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->changePassword();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $data['password']=\Hash::make($request->password);
                $user = User::where('id', '=', $request->id)->update($data);
                $success['user'] =  $user;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Password changed Successfully.";
                
        }
        return $this->populateresponse();
    }


    public function signup(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->signup();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $data['facebook_id']=$request->facebook_id;
                $data['google_id']=$request->google_id;
                $data['first_name']=$request->first_name;              
                $data['last_name']=$request->last_name;                 
                $data['date_of_birth']=$request->date_of_birth;             
                $data['email']=$request->email;                     
                $data['address']=$request->permanent_address;         
                $data['country']=$request->country;                   
                $data['state']=$request->state;                     
                $data['city']=$request->city;
                $data['user_type']=$request->user_type;
                $data['mobile']=$request->mobile;
                $data['otp']='KSKD';
                $data['password']=\Hash::make($request->password);
                $data['remember_token']=\Hash::make($request->password);

                $provider['bank_name']=$request->bank_name;                 
                $provider['bank_account_number']=$request->bank_account;              
                $provider['bank_holder_name']=$request->bank_holder_name;          
                $provider['bank_ifsc_code']=$request->bank_ifsc_code;            
                $provider['service_start_time']=$request->service_start_time;        
                $provider['service_end_time']=$request->service_end_time;          
                $provider['distance_travel']=$request->distance_travel;           
                $provider['long_distance_travel']=$request->long_distance_travel; 

                $provider['service_id']=$request->service_id;
                $provider['price_per_hour']=$request->price_per_hour;
                $provider['price_per_children']=$request->price_per_children;
                $provider['experience_in_work']=$request->experience_in_work;

                $provider['term_condition']=$request->term_condition;  

                if($request->file('document_high_school')){
                    $path = url('/assets/images/document/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_high_school');
                    $document_high_school    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/document/' .$document_high_school);
                    $provider['document_high_school'] = $document_high_school;
                }   

                if($request->file('document_graduation')){
                    $path = url('/assets/images/document/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_graduation');
                    $document_graduation    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/document/' .$document_graduation);
                    $provider['document_graduation'] = $document_graduation;
                }       
                if($request->file('document_post_graduation')){
                    $path = url('/assets/images/document/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_post_graduation');
                    $document_post_graduation    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/document/' .$document_post_graduation);
                    $provider['document_post_graduation'] = $document_post_graduation;
                } 
                if($request->file('document_adhar_card')){
                    $path = url('/assets/images/document/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_adhar_card');
                    $document_adhar_card    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/document/' .$document_adhar_card);
                    $provider['document_adhar_card'] = $document_adhar_card;
                }

                if($request->file('document_other')){
                    $path = url('/assets/images/document/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_other');
                    $document_other    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/document/' .$document_other);
                    $provider['document_other'] = $document_other;
                }
                if($request->file('video')){
                    $path = url('/assets/images/video/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    //$image       = $request->file('video');
                  //  $video    = time().$image->getClientOriginalName();
                    /*$image       = $request->file('video');
                    $video    = time().$image->getClientOriginalName();
                    $image = Image::make(base64_decode($request->file('video')));
                   // $image = Image::make($image->getRealPath());  
                    $image->storeAs('assets/images/video/', $video);    */     
                    //$image->save('assets/images/video/' .$video);

                //$png_url = "user-".time().".png";
                   // dd($video);
                $path = "assets/images/video/".$request['video'];
                $base=base64_decode($request['video']);
                Image::make($base)->save($path);

                    $provider['video'] = $video;
                }
                if($request->file('photo')){
                    $path = url('/assets/images/photo/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('photo');
                    $photo    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/photo/' .$photo);
                    $provider['photo'] = $photo;
                }

                $user = User::create($data);
                $provider['user_id']=$user->id;
                $provider_user = ProviderUser::create($provider);
/*
                $subject = "Reset Password Request";
                $msg = "Your OTP is : ".$autopass;
                $emailData               = ___email_settings();
                $emailData['name']       = $user->name; //!empty($request->name)?$request->name:'';
                $emailData['email']      = !empty($request->email)?$request->email:'';
                $emailData['subject']    = 'Reset Password Request';
                $emailData['password']    = !empty($autopass)?$autopass:'';
                $emailData['date']       = date('Y-m-d H:i:s');

                $emailData['custom_text'] = 'Your Enquiry has been submitted successfully';
                $mailSuccess = ___mail_sender($emailData['email'],$request->name,"forgot_password",$emailData);
               
       
               */
                $success['success'] =  'success';
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Provider added Successfully. Please Check your email.";
               
            
        }
        return $this->populateresponse();
    }


    
    public function verifyEmailPhone(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->verifyEmailPhone();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $autopass = strtoupper(str_random(4));
            $data['otp'] = $autopass;

            if(is_numeric($request->username)){
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
                $success['otp'] =  $autopass;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Verification OTP send Successfully. Please Check your Register Mobile Number.";

            }else{
                $user = User::where(['email' => $request->username])->first();
                $upd = User::where(['email' => $request->username])->update($data);
                $subject = "Email Verification OTP";
                $msg = "Your OTP is : ".$autopass;
                $emailData               = ___email_settings();
                $emailData['name']       = $user->name; //!empty($request->name)?$request->name:'';
                $emailData['email']      = !empty($request->username)?$request->username:'';
                $emailData['subject']    = 'Email Verification OTP';
                $emailData['message']    = '';
                $emailData['otp']        = !empty($autopass)?$autopass:'';
                $emailData['date']       = date('Y-m-d H:i:s');

                $emailData['custom_text'] = 'Your Enquiry has been submitted successfully';
                $mailSuccess = ___mail_sender($emailData['email'],$user->name,"verify_email",$emailData);
                $success['otp'] =  $autopass;
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Verification OTP send Successfully. Please Check your email.";
            }

        }
        return $this->populateresponse();
    }

    public function city(Request $request)
    {

        $city = City::where('state_id',$request->state_id)->get();
        $success['city'] =  $city;
        $this->status   = true;
        $response = new Response($success);
        $this->jsondata = $response->api_common_response();
        $this->message = "Successfully.";
                
        return $this->populateresponse();
    }
    public function country(Request $request)
    {

        $country = Country::get();

        $success['country'] =  $country;
        $this->status   = true;
        $response = new Response($success);
        $this->jsondata = $response->api_common_response();
        $this->message = "Successfully.";
                
        return $this->populateresponse();
    }
    public function state(Request $request)
    {
        $state = State::where('country_id',$request->country_id)->get();
        $success['state'] =  $state;
        $this->status   = true;
        $response = new Response($success);
        $this->jsondata = $response->api_common_response();
        $this->message = "Successfully.";
                
        return $this->populateresponse();
    }

}