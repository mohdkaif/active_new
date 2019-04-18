<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Models\State;
use App\Models\Faq; 
use App\Models\Feedback;  
use App\Models\Country; 
use App\Models\City; 
use App\Models\UserChild;
use App\Models\NotificationHistory; 
use App\Models\Booking;
use App\Models\Service;
use App\Models\Location;
use App\Models\ServiceDays;
use App\Models\ProviderUser; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Validations\Validate as Validations;
use Perks\Response;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use TextLocal;
use App\Models\SubscriptionProvider;
use App\Models\Subscription;

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

            if(is_numeric($request->username)){

                $CheckUser = \DB::table('users')->where('mobile',$request->username)->update(['facebook_id'=>$request->facebook_id]);
                $user_details = _arefy(User::where('mobile',$request->username)->get());
            }else{
                $CheckUser = \DB::table('users')->where('email',$request->username)->update(['facebook_id'=>$request->facebook_id]);
                $user_details = _arefy(User::where('email',$request->username)->get());
            }
            /*if($CheckUser){*/
                $success['user_details']=$user_details;
             /*   $success['token'] =  $CheckUser->createToken('MyApp')->accessToken;*/
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Facebook login Successful";

            /*}else{
                $success['user_details']='';
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Facebook user not found";
            }*/
            return $this->populateresponse();

        }elseif(!empty($request->google_id)){
            
            //$CheckUser = User::where('google_id',$request->google_id)->first();
            if(is_numeric($request->username)){
                $CheckUser = \DB::table('users')->where('mobile',$request->username)->update(['google_id'=>$request->google_id]);
                $user_details = _arefy(User::where('mobile',$request->username)->get());
            }else{
                 $CheckUser = \DB::table('users')->where('email',$request->username)->update(['google_id'=>$request->google_id]);
                 $user_details = _arefy(User::where('email',$request->username)->get());
            }
            
           /* if($CheckUser){*/
                $success['user_details']=$user_details;
                /*$success['token'] =  $CheckUser->createToken('MyApp')->accessToken;*/
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Google login Successful";

            /*}else{
                $success['user_details']='';
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Google user not found";
            }*/
            return $this->populateresponse();

        }

        else{
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
    }

    public function forgotPassword(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->forgotpass();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            
                $user = Auth::user();
                $digits = 4;
                $autopass = rand(pow(10, $digits-1), pow(10, $digits)-1); 
                /*$autopass = strtoupper(str_random(8));*/
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
               /* $mailSuccess = ___mail_sender($emailData['email'],$user->name,"forgot_password",$emailData);*/
                User::where('email', '=', $request->username)->update(['otp'=>$autopass]);
        
                $to = $emailData['email'];
                $subject = "Reset Password Request";
                $txt = "Your OTP for Password Reset is: ".$input['otp'];
                $headers = "From: kaif.igniterpro@gmial.com";

                mail($to,$subject,$txt,$headers);

                $success['otp'] =  $autopass;
                $success['user_details']=$user;
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

               
                $success['user_details']=$user;
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
        
        $user = User::where('id', '=', $request->user_id)->first();
        
        if(!empty($user)){
            $success['user_details']=$user;
            /*$autopass = strtoupper(str_random(6));*/
            $digits = 4;
            $autopass = rand(pow(10, $digits-1), pow(10, $digits)-1);
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
        
                
        }else{
            $this->status   = true;
            $success['user_details'] =[];
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "User does not exist.";
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
                $user_deatils = User::where('id', '=', $request->id)->firstOrFail();
                $success['user'] =  $user_deatils;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Password changed Successfully.";
                
        }
        return $this->populateresponse();
    }

    public function ResetPassword(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->resetPassword();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $data['password']=\Hash::make($request->password);
                $user = User::where('id', '=', $request->user_id)->update($data);
                $user_deatils = User::where('id', '=', $request->user_id)->firstOrFail();
                $success['user'] =  $user_deatils;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Password changed Successfully.";
                
        }
        return $this->populateresponse();
    }

    public function deleteUser(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->getUserInfo();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $user_id = $request->user_id;
               
                $user = User::where('id', '=', $user_id)->get()->first();
                if(!empty($user)){
                    if($user->user_type=='provider'){

                        $user_info = User::where('id',$user_id)->delete();
                        $user_info = ProviderUser::where('user_id',$user_id)->delete();
                    }else{
                        $user_info = User::where('id',$user_id)->delete();
                    }
                    $this->message = "User deleted Successfully.";
                }else{
                    $this->message = "No user found with this data.";
                     /*$success['user_details'] =  'No user found with this data';*/
                }
                
                $success['success'] =  'success';
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                
                
        }
        return $this->populateresponse();
    }

    public function getUserInfo(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->getUserInfo();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{

            $user_id = $request->user_id;
               
                $user = User::where('id', '=', $user_id)->get()->first();
                $success['contact_no'] =  '+91-9044443264';
                if(!empty($user)){

                    if($user->user_type=='provider'){
                        $user_info = _arefy(User::provider_list('single','id = '.$user_id));
                        $row = _arefy(SubscriptionProvider::where(['user_id'=>$user_id,'payment_status'=>'completed'])->get());

                        $flag = false;

                        if(!empty($row)){

                            ////For all the rows , check if  payment completed row has not expired , one row should be there, otherwise all are previous month transactions for subscriptions.
                            foreach ($row as $key1 => $value1) {

                                $flag = false;

                                $sub_id = $value1['subscription_id'];
                                $sub_details = Subscription::where('id',$sub_id)->first();
                                $months = $sub_details->months;

                                $expiring_date = strtotime(date('Y-m-d', strtotime("+".$months." months", strtotime($value1['date']))));
                                
                                $todays_time = strtotime(date('Y-m-d'));
                                if($expiring_date>$todays_time){

                                    ///Yes there is one subscription that has not expired
                                    $flag=true;
                                    break;
                                }


                            }
                        }

                        if(!empty($flag) && $flag==true){
                            $user_info['provider_user']['subscribed'] = 'true';
                        }else{
                            $user_info['provider_user']['subscribed'] = 'false'; 
                        }
                        
                    }else{
                        $user_info = _arefy(User::where('id',$user_id)->get()->first());
                    }

                    $user_info['image'] = url('assets/images/users/'.$user_info['image']);
                    $success['user_details'] =  $user_info;
                }else{
                    $success['user_details'] =  'No user found with this data';
                }
                
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Success.";
                
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
                $data['gender']=(!empty($request->gender))?$request->gender:'';
                $data['user_type'] = $request->type;
                $data['first_name'] = $request->first_name;
                $data['last_name'] = $request->last_name;
                $data['mobile'] = $request->mobile;

                $digits = 4;
                $autopass = rand(pow(10, $digits-1), pow(10, $digits)-1);

                $data['otp'] = $autopass;

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
                $data['special_service']=(!empty($request->special_service))?$request->special_service:'';
                $data['gender']=(!empty($request->gender))?$request->gender:'';
                $data['user_type'] = $request->type;
                $data['first_name'] = $request->first_name;
                $data['last_name'] = $request->last_name;
                $data['mobile'] = $request->mobile;

                $digits = 4;
                $autopass = rand(pow(10, $digits-1), pow(10, $digits)-1);

                $data['otp'] = $autopass;

                 

                $data['email'] = $request->email;
                $data['permanent_address'] =(!empty($request->permanent_address))?$request->permanent_address:'';
                $data['permanent_country'] = (!empty($request->country))?$request->country:'';
                $data['permanent_state'] = (!empty($request->state))?$request->state:'';
                $data['permanent_city'] = (!empty($request->city))?$request->city:'';
                $data['address'] =(!empty($request->permanent_address))?$request->permanent_address:'';
                $data['country'] = (!empty($request->country))?$request->country:'';
                $data['state'] = (!empty($request->state))?$request->state:'';
                $data['city'] = (!empty($request->city))?$request->city:'';
                $data['permanent_pincode'] = (!empty($request->pincode))?$request->pincode:'';
                $data['pincode'] = (!empty($request->pincode))?$request->pincode:'';
                $data['password'] = \Hash::make($request->password);
                $data['status'] = 'pending';
                $data['date_of_birth'] =(!empty($request->date_of_birth))?$request->date_of_birth:'';
                $data['email'] = isset($request->email)?$request->email:'';
               

                if ($file = $request->file('image')){
                    $photo_name = time().$request->file('image')->getClientOriginalName();
                    $file->move('assets/images/users',$photo_name);
                    $data['image'] = $photo_name;
                   
                }
                
                $user = User::create($data);

                $provider['bank_name']=(!empty($request->bank_name))?$request->bank_name:'';              
                $provider['bank_account_number']=(!empty($request->bank_account))?$request->bank_account:'';         
                $provider['bank_holder_name']=(!empty($request->bank_holder_name))?$request->bank_holder_name:'';      
                $provider['bank_ifsc_code']=(!empty($request->bank_ifsc_code))?$request->bank_ifsc_code:'';
                $provider['bank_branch_name']=(!empty($request->bank_branch_name))?$request->bank_branch_name:'';
                

                $provider['graduation_year']=(!empty($request->graduation_year))?$request->graduation_year:'';              
                $provider['post_graduation_year']=(!empty($request->post_graduation_year))?$request->post_graduation_year:'';         
                $provider['highschool_year']=(!empty($request->high_school_year))?$request->high_school_year:'';      
                $provider['intermediate_year']=(!empty($request->intermediate_year))?$request->intermediate_year:'';

              /*  $provider['service_start_time']=$request->service_start_time;        
                $provider['service_end_time']=$request->service_end_time; */         
                $provider['distance_to_travel']=(!empty($request->distance_travel))?$request->distance_travel:'';            
                $provider['long_distance_travel']=(!empty($request->long_distance_travel))?$request->long_distance_travel:''; 
                $provider['location_track_permission']=(!empty($request->location_track_permission) && $request->location_track_permission=='yes')?$request->location_track_permission:'no';

                $provider['term_condition']=$request->term_condition;
                $provider['special_service']=(!empty($request->special_service))?$request->special_service:'';  
                /*$provider['service_id']=$request->service_id;  */
               if($request->file('document_high_school')){
                    $path = 'assets/document/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_high_school');
                    $document_high_school    = time().$image->getClientOriginalName();
                    $res = $image->move($path, $document_high_school);
                    /*$image = Image::make($image->getRealPath());              
                    $image->save('assets/document/' .$document_high_school);*/
                    $provider['document_high_school'] = $document_high_school;
                }   

                if($request->file('document_graduation')){
                    $path = 'assets/document/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_graduation');
                    $document_graduation    = time().$image->getClientOriginalName();
                    $res = $image->move($path, $document_graduation);
                    $provider['document_graduation'] = $document_graduation;
                }       
                if($request->file('document_post_graduation')){
                    $path = 'assets/document/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_post_graduation');
                    $document_post_graduation    = time().$image->getClientOriginalName();
                    $res = $image->move($path, $document_post_graduation);
                    
                    $provider['document_post_graduation'] = $document_post_graduation;
                } 
                if($request->file('document_adhar_card')){
                    $path = 'assets/document/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_adhar_card');
                    $document_adhar_card    = time().$image->getClientOriginalName();
                     $res = $image->move($path, $document_adhar_card);
                    $provider['document_adhar_card'] = $document_adhar_card;
                }

                if($request->file('document_other')){
                    $path = 'assets/document/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_other');
                    $document_other    = time().$image->getClientOriginalName();
                    $res = $image->move($path, $document_other);
                    $provider['document_other'] = $document_other;
                }   
                $provider['user_id']=$user->id;
                $provider_user = ProviderUser::create($provider);

                ////service
                $service['name']=(!empty($request->service_name))?$request->service_name:'';
                $service['description']=(!empty($request->description))?$request->description:'';
                $service['price_per_hour']=(!empty($request->price_per_hour))?$request->price_per_hour:'';
                $service['price_per_children']=(!empty($request->price_per_children))?$request->price_per_children:'';
                $service['experience_in_work']=(!empty($request->experience_in_work))?$request->experience_in_work:'';
                $service['service_category_id']=(!empty($request->service_category_id))?$request->service_category_id:'';
                $service['service_sub_category_id']=(!empty($request->service_sub_category_id))?$request->service_sub_category_id:'';

                if($request->file('video')){
                    $file = $request->file('video');

                    $filename2 = $file->getClientOriginalName();
                    $path = 'assets/service/video/';
                    if(!File::exists($path)) {
                        
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $res = $file->move($path, $filename2);
                    $service['video'] = $filename2;
                }
                if($request->file('photo')){
                    $path = 'assets/service/images/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('photo');
                    $photo    = time().$image->getClientOriginalName();

                    $image = Image::make($image->getRealPath());  
                     
                    $image->save('assets/service/images/' .$photo);
                    $service['photo'] = $photo;
                }
                if(!empty($service['name']) && !empty($provider_user)){

                    $service['provider_id'] = $provider_user->id;
                    $service_added = Service::create($service);
                }

                ///Service days
                $days = (!empty($request->days))?explode(',',$request->days):'';
                $start_time = (!empty($request->start_time))?explode(',',$request->start_time):'';
                $end_time = (!empty($request->end_time))?explode(',',$request->end_time):'';
                if(!empty($days) && !empty($start_time) && !empty($end_time)){
                    foreach($days as $key=> $value){
                        $servicedays['day'] = $value;
                        $servicedays['start_time'] = $start_time[$key];
                        $servicedays['end_time'] = $end_time[$key];
                        $servicedays['provider_id'] = $provider_user->id;
                        $servicedays['service_id'] = $service_added->id;
                        $servicedays['created_at'] = date('Y-m-d H:i:s');
                        $servicedays['updated_at'] = date('Y-m-d H:i:s');
                        ServiceDays::create($servicedays);
                    }
                }
            }

            ////otp
            $apiKey = urlencode('Af8JoCyMRKc-3KCSW0EBcsbim6Y7FVTtg6SD1bOvfC');
            // Message details
            $phone_code=91;
            $numbers = array($phone_code.$data['mobile']);
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
            /////

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
                    $file->move('assets/images/users',$photo_name);
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
            $data['email'] = !empty($request->email)?$request->email:'';
            $data['date_of_birth'] = $request->date_of_birth;
            /*$data['gender'] = $request->gender;*/

            if ($file = $request->file('image')){
                $photo_name = time().$request->file('image')->getClientOriginalName();
                $file->move('assets/images/users',$photo_name);
                $data['image'] = $photo_name;
               
            }
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
                    $path = 'assets/document/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_high_school');
                    $document_high_school    = time().$image->getClientOriginalName();
                    $res = $image->move($path, $document_high_school);
                    /*$image = Image::make($image->getRealPath());              
                    $image->save('assets/document/' .$document_high_school);*/
                    $provider['document_high_school'] = $document_high_school;
                }   

                if($request->file('document_graduation')){
                    $path = 'assets/document/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_graduation');
                    $document_graduation    = time().$image->getClientOriginalName();
                    $res = $image->move($path, $document_graduation);
                    $provider['document_graduation'] = $document_graduation;
                }       
                if($request->file('document_post_graduation')){
                    $path = 'assets/document/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_post_graduation');
                    $document_post_graduation    = time().$image->getClientOriginalName();
                    $res = $image->move($path, $document_post_graduation);
                    
                    $provider['document_post_graduation'] = $document_post_graduation;
                } 
                if($request->file('document_adhar_card')){
                    $path = 'assets/document/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_adhar_card');
                    $document_adhar_card    = time().$image->getClientOriginalName();
                     $res = $image->move($path, $document_adhar_card);
                    $provider['document_adhar_card'] = $document_adhar_card;
                }

                if($request->file('document_other')){
                    $path = 'assets/document/';
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_other');
                    $document_other    = time().$image->getClientOriginalName();
                    $res = $image->move($path, $document_other);
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
                $data['pincode']=$request->current_pincode;
                $data['permanent_address']=$request->permanent_address;         
                $data['permanent_country']=$request->permanent_country;                   
                $data['permanent_state']=$request->permanent_state;                     
                $data['permanent_city']=$request->permanent_city;
                 $data['permanent_pincode']=$request->permanent_pincode;
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

    public function faq(Request $request)
    {
       /* $validation = new Validations($request);
        $validator = $validation->faq();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                $data['question']=!empty($request->question)?$request->question:'';         
                $data['status']='active';                 
                $data['created_at']=date('Y-m-d H:i:s');
                $data['updated_at']=date('Y-m-d H:i:s');
               

                    $insertId = Faq::insert($data);
                
                if($insertId){

                    $success['success'] =  'success';
                    $this->status   = true;
                    $response = new Response($success);
                    $this->jsondata = $response->api_common_response();
                    $this->message = "Query submitted successfully, We will contact you shortly.";
                }
               
            
        }
        return $this->populateresponse();*/
        $faq = _arefy(Faq::list('array'));
        $success['success'] =  'success';
        $success['faq'] =  $faq;
        
        $this->status   = true;
        $response = new Response($success);
        $this->jsondata = $response->api_common_response();
        $this->message = "Success.";
                
        
        return $this->populateresponse();
    }

     public function feedback(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->feedback();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                $data['feedback']=!empty($request->feedback)?$request->feedback:''; 
                $data['user_id']=!empty($request->user_id)?$request->user_id:'';         
                $data['status']='active';                 
                $data['created_at']=date('Y-m-d H:i:s');
                $data['updated_at']=date('Y-m-d H:i:s');
               

                    $insertId = Feedback::insert($data);
                
                if($insertId){

                    $success['success'] =  'success';
                    $this->status   = true;
                    $response = new Response($success);
                    $this->jsondata = $response->api_common_response();
                    $this->message = "Feedback submitted successfully.";
                }
               
            
        }
        return $this->populateresponse();
    }

      public function notification_history()
    {
       
           
        $notification_history = _arefy(NotificationHistory::list('array'));

        if(!empty($notification_history)){
            foreach ($notification_history as $key => $value) {
                $notification_history[$key]['time'] = date('g:i A',strtotime($value['time']));
            }
        }
        $success['success'] =  'success';
        $success['notification_history'] =  $notification_history;
        
        $this->status   = true;
        $response = new Response($success);
        $this->jsondata = $response->api_common_response();
        $this->message = "Success.";
                
        
        return $this->populateresponse();
    }

     public function providerBookingList(Request $request)
    {
       
        $validation = new Validations($request);
        $validator = $validation->providerBookingList();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $where = "provider_id = ".$request->provider_id." AND booking_status = '".$request->booking_status."'";
            $list = _arefy(Booking::list('array',$where));
            $success['success'] =  'success';
            $success['booking_list'] =  $list;
            
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Success.";
               
            
        }
        return $this->populateresponse();
    }

    public function providerSubscriptionList(Request $request)
    {
       
        $validation = new Validations($request);
        $validator = $validation->providerSubscriptionList();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $where = "provider_id = ".$request->provider_id;
            $list = _arefy(Subscription::list('array'));
            if(!empty($list)){
                foreach ($list as $key => $value) {

                    ////Check if it has not expired

                    $rows = _arefy(SubscriptionProvider::where(['provider_id'=>$request->provider_id,'payment_status'=>'completed','subscription_id'=>$value['id']])->get());

                    $flag = false;

                    if(!empty($rows)){
                        

                        ////For all the rows , check if  payment completed row has not expired , one row should be there, otherwise all are previous month transactions for subscriptions.
                        foreach ($rows as $key1 => $value1) {

                            $flag = false;

                            $sub_id = $value['id'];
                           
                            $months = $value['months'];

                            $expiring_date = strtotime(date('Y-m-d', strtotime("+".$months." months", strtotime($value1['date']))));
                            
                            $todays_time = strtotime(date('Y-m-d'));
                            if($expiring_date>$todays_time){

                                ///Yes there is one subscription that has not expired
                                $flag=true;
                                break;
                            }


                        }
                    }

                    if(!empty($flag) && $flag==true){
                        $list[$key]['subscribed'] = 'true';
                    }else{
                        $list[$key]['subscribed'] = 'false'; 
                    }
                    
                }
            }
            $success['success'] =  'success';
            $success['subscription_list'] =  $list;
            
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Success.";
               
            
        }
        return $this->populateresponse();
    }

      public function providerSubscribe(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->subscribe();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                $data['provider_id']=!empty($request->provider_id)?$request->provider_id:''; 
                $data['subscription_id']=!empty($request->subscription_id)?$request->subscription_id:'';
                $data['user_id']= ProviderUser::where('id',$request->provider_id)->first()->user_id; 
                $data['date']= date('Y-m-d');
                $data['time']=date('H:i:s');
                $data['order_number']='428712jhdjas'; 
                $data['price']=Subscription::where('id',$request->subscription_id)->first()->price;
                $data['payment_status']='completed';
                $data['payment_mode']='Net Banking';                 
              
                    $insertId = SubscriptionProvider::insert($data);
                
                if($insertId){

                    $success['success'] =  'success';
                    $this->status   = true;
                    $response = new Response($success);
                    $this->jsondata = $response->api_common_response();
                    $this->message = "Subscribed successfully.";
                }
               
            
        }
        return $this->populateresponse();
    }

     public function updateLocation(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->location();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                $data['user_id']=!empty($request->user_id)?$request->user_id:''; 
                $data['latitude']=!empty($request->latitude)?$request->latitude:'';
                $data['longitude']=!empty($request->longitude)?$request->longitude:'';
                
                $data['created_at']= date('Y-m-d H:i:s');
                $data['updated_at']= date('Y-m-d H:i:s');
                $data['status']= 'active';
                
              
                    $insertId = Location::UpdateOrCreate([
                        'user_id' =>$request->user_id
                    ],$data);
                
                if($insertId){

                    $success['success'] =  'success';
                    $this->status   = true;
                    $response = new Response($success);
                    $this->jsondata = $response->api_common_response();
                    $this->message = "Location Updated successfully.";
                }
               
            
        }
        return $this->populateresponse();
    }


    

    


}