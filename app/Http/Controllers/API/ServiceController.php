<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Models\State; 
use App\Models\Country; 
use App\Models\City; 
use App\Models\ProviderUser;
use App\Models\ServiceCategory;  
use App\Models\ServiceSubCategory;
use App\Models\Service;
use App\Models\ServiceDays;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Validations\Validate as Validations;
use Perks\Response;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use TextLocal;
class ServiceController extends Controller 
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
   

    public function addServiceCategory(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->addServiceCategory();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            
            $data['service_category_name'] = $request->service_category_name;
            $data['status'] = 'active';
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $service = ServiceCategory::add($data);
            $success['success'] =  'success';
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Service Category created successfully";
            
        }
        return $this->populateresponse();
    }

     public function editServiceCategory(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->addServiceCategory('edit');
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $id = $request->service_id;
            $data['service_category_name'] = $request->service_category_name;

            $data['updated_at'] = date('Y-m-d H:i:s');
            $service = ServiceCategory::change($id,$data);
            $success['success'] =  'success';
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Service Category updated successfully";
            
        }
        return $this->populateresponse();
    }



    public function addServiceSubCategory(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->addServiceSubCategory();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['service_category_id'] = $request->service_category_id;
            $data['service_sub_category_name'] = $request->service_sub_category_name;
            $data['status'] = 'active';
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $service = ServiceSubCategory::add($data);
            $success['success'] =  'success';
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Service Sub Category created successfully";
            
        }
        return $this->populateresponse();
    }

     public function editServiceSubCategory(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->addServiceSubCategory('edit');
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $id = $request->id;
            $data['service_category_id'] = $request->service_category_id;
            $data['service_sub_category_name'] = $request->service_sub_category_name;
            $data['updated_at'] = date('Y-m-d H:i:s');
            
            $service = ServiceSubCategory::change($id,$data);
            $success['success'] =  'success';
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Service Category updated successfully";
            
        }
        return $this->populateresponse();
    }

     public function addService(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->addService();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['service_category_id'] = $request->service_category_id;
            $data['service_sub_category_id'] = $request->service_sub_category_id;
            $data['provider_id'] = $request->provider_id;
            $data['name'] = $request->service_name;
           /* $data['description'] = $request->description;*/
          /*  $data['days_for_service'] = $request->days_for_service;
            $data['service_start_time'] = $request->service_start_time;
            $data['service_end_time'] = $request->service_end_time;*/
            $data['special_day'] = $request->special_day;
            $data['price_per_hour'] = $request->price_per_hour;
            $data['price_per_children'] = $request->price_per_children;
            $data['experience_in_work'] = $request->experience_in_work;

            if($request->file('video')){
                $file = $request->file('video');

                $filename2 = $file->getClientOriginalName();
                $path = 'assets/service/video/';
                if(!File::exists($path)) {
                    
                    File::makeDirectory($path, $mode = 0777, true);
                }
                $res = $file->move($path, $filename2);
                $data['video'] = $filename2;
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
                $data['photo'] = $photo;
            }

            $data['status'] = 'active';
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $service = Service::add($data);

            $days = (!empty($request->days))?explode(',',$request->days):'';
            $start_time = (!empty($request->start_time))?explode(',',$request->start_time):'';
            $end_time = (!empty($request->end_time))?explode(',',$request->end_time):'';
            if(!empty($days) && !empty($start_time) && !empty($end_time)){
                foreach($days as $key=> $value){
                    $servicedays['day'] = $value;
                    $servicedays['start_time'] = $start_time[$key];
                    $servicedays['end_time'] = $end_time[$key];
                    $servicedays['provider_id'] = $request->provider_id;
                    $servicedays['service_id'] = $service;
                    $servicedays['created_at'] = date('Y-m-d H:i:s');
                    $servicedays['updated_at'] = date('Y-m-d H:i:s');
                    ServiceDays::create($servicedays);
                }
            }

            
            $success['success'] =  'success';
           /* $success['service'] =  $service;*/
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Service created successfully";
            
        }
        return $this->populateresponse();
    }

     public function editService(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->addService('edit');
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $id = $request->service_id;
            $data['service_category_id'] = $request->service_category_id;
            $data['service_sub_category_id'] = $request->service_sub_category_id;
            $data['provider_id'] = $request->provider_id;
            $data['name'] = $request->service_name;
           /* $data['description'] = $request->description;*/
            /*$data['days_for_service'] = $request->days_for_service;
            $data['service_start_time'] = $request->service_start_time;
            $data['service_end_time'] = $request->service_end_time;*/
            $data['special_day'] = $request->special_day;
            $data['price_per_hour'] = $request->price_per_hour;
            $data['price_per_children'] = $request->price_per_children;
            $data['experience_in_work'] = $request->experience_in_work;

            if($request->file('video')){
                $file = $request->file('video');

                $filename2 = $file->getClientOriginalName();
                $path = 'assets/service/video/';
                if(!File::exists($path)) {
                    
                    File::makeDirectory($path, $mode = 0777, true);
                }
                $res = $file->move($path, $filename2);
                $data['video'] = $filename2;
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
                $data['photo'] = $photo;
            }


            $data['status'] = 'active';
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $service = Service::change($id,$data);

            ServiceDays::where('service_id',$id)->delete();

            $days = (!empty($request->days))?explode(',',$request->days):'';
            $start_time = (!empty($request->start_time))?explode(',',$request->start_time):'';
            $end_time = (!empty($request->end_time))?explode(',',$request->end_time):'';
            if(!empty($days) && !empty($start_time) && !empty($end_time)){
                foreach($days as $key=> $value){
                    $servicedays['day'] = $value;
                    $servicedays['start_time'] = $start_time[$key];
                    $servicedays['end_time'] = $end_time[$key];
                    $servicedays['provider_id'] = $request->provider_id;
                    $servicedays['service_id'] = $id;
                    $servicedays['created_at'] = date('Y-m-d H:i:s');
                    $servicedays['updated_at'] = date('Y-m-d H:i:s');
                    ServiceDays::create($servicedays);
                }
            }
            $success['success'] =  'success';
           /* $success['service'] =  $service;*/
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Service updated successfully";
            
            
            
        }
        return $this->populateresponse();
    }

     public function deleteService(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->deleteService('edit');
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $id = $request->service_id;
            /////Delete service days
            $service_days = ServiceDays::where(['service_id'=>$id])->delete();
            $service = Service::where('id',$id)->delete();
            $success['success'] =  'success';
           /* $success['service'] =  $service;*/
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Service deleted successfully";
            
            
            
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

    public function ServiceCategoryList(Request $request)
    {
      
        $list = _arefy(ServiceCategory::listing('array'));
                
        $success['service_category_list']=$list;
       
        $this->status   = true;
        $response = new Response($success);
        $this->jsondata = $response->api_common_response();
        $this->message = "Success.";
                
        return $this->populateresponse();
    }

    public function ServiceSubCategoryList(Request $request)
    {
      
        $list = _arefy(ServiceSubCategory::listing('array'));
                
        $success['service_sub_category_list']=$list;
       
        $this->status   = true;
        $response = new Response($success);
        $this->jsondata = $response->api_common_response();
        $this->message = "Success.";
                
        return $this->populateresponse();
    }

    public function ServiceListForProvider(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->serviceListProvider();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                
                
            $provider_id = $request->provider_id;
            $list = _arefy(Service::list('array','provider_id = '.$provider_id));
                    
            $success['service_list']=$list;
           
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Success.";
                    
           
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

     public function addServiceDays(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->addServiceDays();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['service_id'] = $request->service_id;
            $data['provider_id'] = $request->provider_id;
            $data['day'] = $request->day;
            $data['start_time'] = $request->start_time;
            $data['end_time'] = $request->end_time;
          /*  $data['days_for_service'] = $request->days_for_service;
            $data['service_start_time'] = $request->service_start_time;
            $data['service_end_time'] = $request->service_end_time;*/
            $data['created_at'] =date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $inserId = ServiceDays::updateOrCreate([
                        'provider_id'=>$data['provider_id'] ,
                        'service_id'=>$data['service_id'] ,
                        'day' => $data['day']
                        ],$data
                    );

           
           /* $service = ServiceDays::add($data);*/
            $success['success'] =  'success';
           /* $success['service'] =  $service;*/
            $this->status   = true;
            $response = new Response($success);
            $this->jsondata = $response->api_common_response();
            $this->message = "Service Days created successfully";
            
        }
        return $this->populateresponse();
    }
    //////id status expiry date expiry time title price months desc

}