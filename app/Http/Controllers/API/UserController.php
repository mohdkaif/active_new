<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Models\State; 
use App\Models\Country; 
use App\Models\City; 
use App\Models\UserChild;
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
        
        $user = User::where('id', '=', $request->user_id)->firstOrFail();
        if($user){
            $success['user_details']=$user;
            $autopass = strtoupper(str_random(6));
            $input['otp'] = $autopass;
            $upd = $user->update($input);

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
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "OTP Sent Successfully.";
        
                
        }
        return $this->populateresponse();
    }

    public function verifyOtp(Request $request)
    {   
        
        $validation = new Validations($request);
        $validator = $validation->verifyOtp();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            
            $user = User::where('id', '=', $request->user_id)->firstOrFail();
            if($request->otp==$user->otp){
                $input['is_mobile_verified'] = 'yes';
                $upd = $user->update($input);

                $success['success'] = 'success';
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Mobile Verification Successful";
                
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

    public function SignUp2(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->signup();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            if($request->type == 'user'){
                $data['facebook_id']=(!empty($request->facebook_id))?$request->facebook_id:'';
                $data['google_id']=(!empty($request->google_id))?$request->google_id:'';
                $data['user_type'] = $request->type;
                $data['first_name'] = $request->first_name;
                $data['last_name'] = $request->last_name;
                $data['mobile'] = $request->mobile;
                $data['otp'] = '11331';
                $data['email'] = $request->email;
                $data['address'] = (!empty($request->address))?$request->address:'';
                $data['country'] = $request->region;
                $data['state'] = $request->state;
                $data['city'] = $request->city;
                $data['password'] = \Hash::make($request->password);
                $data['status'] = 'active';
               /* $data['service_id'] = 2;*/
                $data['email'] = isset($request->email)?$request->email:'';
                $user = User::create($data);
                if(!empty($request->child_name)){

                    foreach ($request->child_name as $key => $name) {  
                        $child[$key]['name'] = $name;
                    }
                }
                if(!empty($request->child_age)){
                    
                  
                    foreach ($request->child_age as $key => $age) {
                        $child[$key]['age'] = $age;
                    }
                }
                if(!empty($request->child_gender)){
                    foreach ($request->child_gender as $key => $gender) {
                        $child[$key]['gender'] = $gender;
                    }
                }
                if(!empty($child)){

                    foreach ($child as $child_details) {
                        $childData['user_id'] = $user->id;
                        $childData['name'] = $child_details['name'];
                        $childData['age'] = $child_details['age'];
                        $childData['gender'] = $child_details['gender'];
                        $childData['status'] = 'active';
                        $save_child = UserChild::create($childData);
                    }
                }


            }else{
                $data['facebook_id']=(!empty($request->facebook_id))?$request->facebook_id:'';
                $data['google_id']=(!empty($request->google_id))?$request->google_id:'';
                $data['user_type'] = $request->type;
                $data['first_name'] = $request->first_name;
                $data['last_name'] = $request->last_name;
                $data['mobile'] = $request->mobile;
                $data['otp'] ='fcevf';
                $data['email'] = $request->email;
                $data['address'] =(!empty($request->address))?$request->address:'';
                $data['country'] = (!empty($request->country))?$request->country:'';
                $data['state'] = (!empty($request->state))?$request->state:'';
                $data['city'] = (!empty($request->city))?$request->city:'';
                $data['password'] = \Hash::make($request->password);
                $data['status'] = 'pending';
                $data['date_of_birth'] =(!empty($request->date_of_birth))?$request->date_of_birth:'';
                $data['email'] = isset($request->email)?$request->email:'';
                $data['otp'] = 'SHDJS';
                if ($file = $request->file('image')){
                    $photo_name = time().$request->file('image')->getClientOriginalName();
                    $file->move('assets/images/providers',$photo_name);
                    $data['image'] = $photo_name;
                   
                }
                $user = User::create($data);

                $provider['bank_name']=(!empty($request->bank_name))?$request->bank_name:'';              
                $provider['bank_account_number']=(!empty($request->bank_account))?$request->bank_account:'';         
                $provider['bank_holder_name']=(!empty($request->bank_holder_name))?$request->bank_holder_name:'';      
                $provider['bank_ifsc_code']=(!empty($request->bank_ifsc_code))?$request->bank_ifsc_code:'';
                $provider['bank_branch_name']=(!empty($request->bank_branch_name))?$request->bank_branch_name:'';
          
              /*  $provider['service_start_time']=$request->service_start_time;        
                $provider['service_end_time']=$request->service_end_time; */         
                $provider['distance_travel']=(!empty($request->distance_travel))?$request->distance_travel:'';            
                $provider['long_distance_travel']=(!empty($request->long_distance_travel))?$request->long_distance_travel:''; 
                $provider['location_track_permission']=(!empty($request->location_track_permission) && $request->location_track_permission=='yes')?$request->location_track_permission:'no';

                $provider['term_condition']=$request->term_condition;  
                /*$provider['service_id']=$request->service_id;  */
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
                $provider['user_id']=$user->id;
                $provider_user = ProviderUser::create($provider);
            }

            $success['success'] =  'success';
            $success['user_details'] =  $user;
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "SignUp Successful.";


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
                $provider['bank_branch_name']=$request->bank_branch_name; 

                /*$provider['service_start_time']=$request->service_start_time;        
                $provider['service_end_time']=$request->service_end_time;*/          
                $provider['distance_travel']=$request->distance_travel;           
                $provider['long_distance_travel']=$request->long_distance_travel; 
                $provider['location_track_permission']=(!empty($request->location_track_permission) && $request->location_track_permission=='yes')?$request->location_track_permission:'no';
                if ($file = $request->file('image')){
                    $photo_name = time().$request->file('image')->getClientOriginalName();
                    $file->move('assets/images/providers',$photo_name);
                    $data['image'] = $photo_name;
                   
                }
                /*$provider['service_id']=$request->service_id;*/
               /* $provider['price_per_hour']=$request->price_per_hour;
                $provider['price_per_children']=$request->price_per_children;
                $provider['experience_in_work']=$request->experience_in_work;*/

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
                /*if($request->file('video')){
                    $path = url('/assets/images/video/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
               
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
                }*/

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
                $success['user_details'] =  $user;
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

    public function profile(Request $request)
    {
        $user = _arefy(User::provider_list('single','id = '.$request->user_id));
        $success['user_datails'] =  $user;
        $this->status   = true;
        $response = new Response($success);
        $this->jsondata = $response->api_common_response();
        $this->message = "Successfully.";
                
        return $this->populateresponse();
    }

     public function updateProfile(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->updateProfile();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            
                $data['first_name'] = $request->first_name;
                $data['last_name'] = $request->last_name;
                $data['address'] = $request->address;
                $data['date_of_birth'] = $request->date_of_birth;
                $data['gender'] = $request->gender;
               
                $update = User::change($request->user_id,$data);
            
            $this->status   = true;
            $success['success'] =  $update;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Profile Updated Successful";
        }
        return $this->populateresponse();
    }

     public function addBankDetail(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->bankDetail();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                $provider['bank_name']=$request->bank_name;    
                $provider['bank_branch_name']=$request->bank_branch_name;              
                $provider['bank_account_number']=$request->bank_account_number;              
                $provider['bank_holder_name']=$request->bank_holder_name;          
                $provider['bank_ifsc_code']=$request->bank_ifsc_code;            
                $user_id = $request->user_id;
                
                $user = ProviderUser::changeUserDetails($user_id,$provider);
               
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
                $this->message = "Provider's Bank Details Added Successfully.";
               
            
        }
        return $this->populateresponse();
    }

    public function addQualification(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->addQualification();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                $provider['highschool_year']=$request->highschool_year; 
                $provider['intermediate_year']=$request->intermediate_year;                
                $provider['graduation_year']=$request->graduation_year;              
                $provider['post_graduation_year']=$request->post_graduation_year;            
                $user_id = $request->user_id;
                
                $user = ProviderUser::changeUserDetails($user_id,$provider);
                $success['success'] =  'success';
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Provider's Qualification details updated Successfully.";
               
            
        }
        return $this->populateresponse();
    }

    public function addDocuments(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->addDocuments();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
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
                $user_id = $request->user_id;
                if(!empty($provider)){

                    $user = ProviderUser::changeUserDetails($user_id,$provider);
                }
               
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
                $this->message = "Provider's Documents Added Successfully.";
               
            
        }
        return $this->populateresponse();
    }

     public function updateAddress(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->updateAddress();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                $data['address']=$request->current_address;         
                $data['country']=$request->current_country;                   
                $data['state']=$request->current_state;                     
                $data['city']=$request->current_city;
                $data['permanent_address']=$request->permanent_address;         
                $data['permanent_country']=$request->permanent_country;                   
                $data['permanent_state']=$request->permanent_state;                     
                $data['permanent_city']=$request->permanent_city;
                $user_id = $request->user_id;
                if(!empty($data)){

                    $user = User::change($user_id,$data);
                }
               
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
                $this->message = "Address Details Updated Successfully.";
               
            
        }
        return $this->populateresponse();
    }

}