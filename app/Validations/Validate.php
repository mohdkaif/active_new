<?php

namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
Use App\User;
use Hash;
/**
* 
*/
class Validate
{
	protected $data;
	public function __construct($data){
		$this->data = $data;
	}

	private function validation($key){
		$validation = [
			'id'					=> ['required'],
			'email'					=> ['nullable','email'],
			'req_email'				=> ['required','email'],
			'first_name' 			=> ['required','string'],
			'name' 					=> ['required','string'],
			'name_product' 			=> ['required','string'],
			'last_name' 			=> ['nullable','string'],
			'date_of_birth' 		=> ['nullable','string'],
			'gender' 				=> ['required','string'],
			'phone_code' 			=> ['nullable','required_with:mobile_number','string'],
			'mobile_number' 		=> ['required','numeric'],
			'req_mobile_number' 	=> ['required','required_with:phone_code','numeric'],
			'country' 				=> ['required','string'],
			'address'           	=> ['nullable','string','max:1500'],
			'qualifications'    	=> ['required','string','max:1500'],
			'specifications'    	=> ['nullable','string','max:1500'],
			'description'       	=> ['required','string'],
			'slug_cat'				=> ['required','max:255'],
			'title'             	=> ['required','string'],
			'profile_picture'   	=> ['required','mimes:doc,docx,pdf','max:2048'],
			'pin_code' 				=> ['nullable','max:6','min:4'],
			'appointment_date'  	=> ['required','string'],
			'type' 	            	=> ['required','string'],
			'phone' 	        	=> ['required','numeric'],
			'course' 	        	=> ['required','string'],
			'location' 	        	=> ['required','string'],
			'comments' 	        	=> ['required','string'],
			'password'          	=> ['required','string','max:50'],
			'c_password'          	=> ['required','same:password'],
			'price'					=> ['required','numeric'],
			'country'					=> ['nullable','numeric'],
			'start_from'			=> ['required'],
			'photo'					=> ['required','mimes:jpg,jpeg,png','max:2408'],
			'photomimes'			=> ['mimes:jpg,jpeg,png','max:2408'],
				'doc_file_any'			=> ['nullable','mimes:jpg,jpeg,png,doc,docx,pdf','max:5120'],
			'video'  				=> ['mimes:mp4,mov,ogg,qt','max:51200'],
			'photo_null'			=> ['nullable'],
			'gallery'				=> ['required','mimes:jpg,jpeg,png','max:2048'],
			'gallery_null'			=> ['nullable'],
			'url' 				    => ['required','url'],
			'slug_no_space'		    => ['required','alpha_dash','max:255'],
			'password_check'	    => ['required'],
			'file'					=> ['required','mimes:pdf'],
			'document_file'		    => ['nullable','mimes:jpg,jpeg,png','max:5120'],
			'newpassword'		    => ['required','max:10'],	
			'child'		    		=> ['required','array','min:1'],	
			'child_details'		    => ['required','string','distinct','min:1'],
			'video_null'			=> ['nullable','mimes:mp4,mov,ogg,qt','max:51200'],
			'photo_null'			=> ['nullable','mimes:jpg,jpeg,png','max:2048'],


		];
		return $validation[$key];
	}
	public function login(){
		if(is_numeric($this->data->username)){
			$validations = [
			    'username' 		       => $this->validation('mobile_number'),
				'password'       	   => $this->validation('password'),
			];
			$validator = \Validator::make($this->data->all(), $validations,[
				'username.required' 						=>  'E-mail/Mobile number is required.',
				'username.numeric' 						    =>  'The Mobile Number must be a numeric.'
			]);
			if(!empty($this->data->username)){
				$userDetails = User::where('mobile',$this->data->username)->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('username', 'No Account Found With This Mobile Number.');
			    	}elseif($userDetails->status!='active'){
			    		$validator->errors()->add('username', 'Your account is not active.Please contact with adminstrator for more info.');
			    	}elseif($userDetails->user_type=='admin'){
			    		$validator->errors()->add('username', 'You are not authorised user to login.');
			    	}/*elseif($userDetails->is_mobile_verified=='no'){
			    		$validator->errors()->add('username', 'You have not verified your mobile number.Please verify to continue');
			    	} */       
			    });
			}
		}else{
			$validations = [
			    'username' 		       => $this->validation('req_email'),
				'password'       	   => $this->validation('password'),
			];
			$validator = \Validator::make($this->data->all(), $validations,[
				'username.required' 						=>  'E-mail/Mobile Number is required.',
				'username.email' 						    =>  'The email must be a valid email address.'
			]);
			if(!empty($this->data->username)){
				$userDetails = User::where('email',$this->data->username)->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('username', 'No Account Found With This Email.');
			    	}elseif($userDetails->status!='active'){
			    		$validator->errors()->add('username', 'Your account is not active.Please contact with adminstrator for more info.');
			    	}elseif($userDetails->user_type=='admin'){
			    		$validator->errors()->add('username', 'You are not authorised user to login.');
			    	}/*elseif($userDetails->is_mobile_verified=='no'){
			    		$validator->errors()->add('username', 'You have not verified your mobile number.Please verify to continue');
			    	}    */    
			    });
			}
		}

		return $validator;		
	}

	public function forgotpass(){
		if(is_numeric($this->data->username)){
			$validations = [
	        	'username' 						=> $this->validation('mobile_number')
	    	];
	    	$validator = \Validator::make($this->data->all(), $validations,[
				'username.required' 						=>  'E-mail/Mobile Number is required.',
				'username.numeric' 						    =>  'The Mobile Number must be a valid number.'
			]);

			if(!empty($this->data->username)){
	    		$userDetails = User::where('mobile',$this->data->username)->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('username', 'No Account Found With This Email.');
			    	}        
			    });
	    	}
	    }else{
	    	$validations = [
	        	'username' 						=> $this->validation('req_email')
	    	];
	    	$validator = \Validator::make($this->data->all(), $validations,[
				'username.required' 						=>  'E-mail/Mobile Number is required.',
				'username.email' 						    =>  'The email must be a valid email address.'
			]);

			if(!empty($this->data->username)){
	    		$userDetails = User::where('email',$this->data->username)->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('username', 'No Account Found With This Email.');
			    	}        
			    });
	    	}
	    }
		return $validator;
    }
	

	public function otp(){
		$validations = [
        	'otp' 						=> $this->validation('name')
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[
			'otp.required' 						=>  'OTP is required.',
			
		]);
		if(!empty($this->data->otp)){
    		$userDetails = User::where('otp',$this->data->otp)->first();
		    $validator->after(function ($validator) use($userDetails) {
		    	if(empty($userDetails)){
		    		$validator->errors()->add('otp', 'No Account Found With This OTP.');
		    	}        
		    });
    	}
		return $validator;
	}

	public function location(){
		$validations = [
        	'user_id' 						=> $this->validation('name'),
        	'latitude' 						=> $this->validation('name'),
        	'longitude' 						=> $this->validation('name'),

    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		
		return $validator;
	}

	public function providerBookingList(){
		$validations = [
        	'provider_id' 						=> $this->validation('name'),
        	'booking_status' 						=> $this->validation('name')
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);

		if(!empty($this->data->provider_id)){
    		$userDetails = \App\Models\ProviderUser::where('id',$this->data->provider_id)->first();
		    $validator->after(function ($validator) use($userDetails) {
		    	if(empty($userDetails)){
		    		$validator->errors()->add('provider_id', 'No Account Found With This id.');
		    	}        
		    });
    	}
		return $validator;
	}

	public function providerSubscriptionList(){
		$validations = [
        	'provider_id' 						=> $this->validation('name'),
        
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[]);

		if(!empty($this->data->provider_id)){
    		$userDetails = \App\Models\ProviderUser::where('id',$this->data->provider_id)->first();
		    $validator->after(function ($validator) use($userDetails) {
		    	if(empty($userDetails)){
		    		$validator->errors()->add('provider_id', 'No Account Found With This id.');
		    	}        
		    });
    	}
		return $validator;
	}




	public function addServiceCategory($action='add'){
		$validations = [
        	'service_category_name' 						=> $this->validation('name'),
    	];
    	if($action=='edit'){
    		
    			$validations['id'] = $this->validation('id');
    		
    	}
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function getUserInfo($action='add'){
		$validations = [
        	'user_id' 						=> $this->validation('name'),
    	];
    	
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function subscribe($action='add'){
		$validations = [
        	'provider_id' 						=> $this->validation('id'),
        	'subscription_id' 						=> $this->validation('id'),
    	];
    	
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}
	public function addState($action='add'){
		$validations = [
        	'country_id' 						=> $this->validation('id'),
        	'state_name' 						=> $this->validation('name'),
    	];
    	
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

		public function addCity($action='add'){
		$validations = [
        	'country_id' 						=> $this->validation('id'),
        	'state_id' 						=> $this->validation('id'),
        	'city_name' 						=> $this->validation('name'),
    	];
    	
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function deleteService($action='add'){
		$validations = [
        	'service_id' 						=> $this->validation('id'),
        /*	'provider_id' 						=> $this->validation('id'),*/
    	];
    
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function serviceListProvider($action='add'){
		$validations = [
        	/*'service_id' 						=> $this->validation('id'),*/
        	'provider_id' 						=> $this->validation('id'),
    	];
    
    	$validator = \Validator::make($this->data->all(), $validations,[]);
		return $validator;
	}

	public function addServiceSubCategory($action='add'){
		$validations = [
			'service_category_id'		  => $this->validation('id'),
        	'service_sub_category_name'   => $this->validation('name'),
    	];
    	if($action=='edit'){
    		
    			$validations['id'] = $this->validation('id');
    		
    	}
    	$validator = \Validator::make($this->data->all(), $validations,[
			'service_category_id.required' 						=>  'Service Category is required.',
			
		]);
		return $validator;
	}

	public function addService($action='add'){
		$validations = [
			'service_category_id'		  => $this->validation('id'),
        	'service_sub_category_id'   => $this->validation('country'),
        	'provider_id'   => $this->validation('phone'),
        	'service_name'   => $this->validation('last_name'),
        	'description'   => $this->validation('address'),
        	/*'days_for_service'   => $this->validation('address'),
        	'service_start_time'		  => $this->validation('name'),
        	'service_end_time'   => $this->validation('name'),*/
        	'special_day'   => $this->validation('last_name'),
        	'price_per_hour'   => $this->validation('name'),
        	'price_per_children'		  => $this->validation('name'),
        	'experience_in_work'   => $this->validation('name'),
        	'photo'   => $this->validation('photo_null'),
        	'video'		  => $this->validation('video_null'),
        
    	];
    	if($action=='edit'){
    		
    			$validations['service_id'] = $this->validation('id');
    		
    	}
    	$validator = \Validator::make($this->data->all(), $validations,[
			'service_category_id.required' 						=>  'Service Category is required.',

		]);
		return $validator;
	}


	public function updateService(){
		$validations = [
        	'service_id' 						=> $this->validation('name')
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[
		
			
		]);
		
		return $validator;
	}

	public function verifyOtp(){
		$validations = [
        	'otp' 						=> $this->validation('name')
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[
		
			
		]);

		if(!empty($this->data->user_id)){

	    		$user = User::findOrFail($this->data->user_id);
	    		
	    		
	    		$validator->after(function ($validator) use($user) {

						if ($this->data->otp!=$user->otp){
							
						    $validator->errors()->add('otp', 'Incorrect OTP');
						  
						}
						
				           
		    	});
    		}else{
    			$validator->after(function ($validator) use($user) {

					$validator->errors()->add('user_id', 'User Id is required');
			         
		    	});
    		}  
		
		return $validator;
	}



	public function updateProfile(){
		$validations = [
        	'first_name'					=> $this->validation('name'),
	        'last_name' 					=> $this->validation('name'),
	        /*'mobile'						=> $this->validation('mobile_number'),*/
	        /*'address'						=> $this->validation('qualifications'),*/
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[
			'first_name'					=> $this->validation('name'),
	        'last_name' 					=> $this->validation('name'),
	        'mobile'						=> $this->validation('mobile_number'),
	        'address'				=> $this->validation('address'),
			
		]);
		
		return $validator;
	}

	public function changeProviderPassword(){
	        $validations = [
	           
	            'old_password'	=> $this->validation('id'),
				'new_password'	=> $this->validation('id'),
				 'confirm_password'  	=> $this->validation('id'),
				
	    	];
	    	$validator = \Validator::make($this->data->all(), $validations,[
    		'old_password.required' 		=>  'Current Password is Required',
    		'new_password.required'     	=>  'New Password is Required',
    		'confirm_password.required'		=>  'Confirm Password is Required',
    		
    	]); 

	    	if(!empty($this->data->old_password)){

	    		$user = User::findOrFail($this->data->id);
	    		
	    		
	    		$validator->after(function ($validator) use($user) {

						if (!(Hash::check($this->data->old_password, $user->password))){
							
						    $validator->errors()->add('old_password', 'Current Password Does not match');
						  
						}
						
				           
		    	});
    		}  

    		if(!empty($this->data->new_password) && !empty($this->data->confirm_password)){

	    		
	    		
	    		
	    		$validator->after(function ($validator) {

						if ($this->data->new_password != $this->data->confirm_password){
						    $validator->errors()->add('confirm_password', 'Confirm Password Does not match');
						}
						
				           
		    	});
    		}  
	        return $validator;		
	}


	public function changePassword(){
		if($this->data->web =='web'){
			$validations = [
			'otp'							=> $this->validation('name'),
			'id'							=> $this->validation('name'),
        	'password' 						=> $this->validation('password'),
        	'confirm_password'				=> $this->validation('c_password')
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[
			
		]);
    	if(!empty($this->data->otp)){

    		$userDetails = User::where(['otp'=> $this->data->otp,'id'=>___decrypt($this->data->id)])->first();
    		
		    $validator->after(function ($validator) use($userDetails) {
		    	if(empty($userDetails)){
		    		$validator->errors()->add('otp', 'Invalid OTP.Please enter correct OTP.');
		    	}        
		    });
    	}
		}else{

			$validations = [
				'otp'							=> $this->validation('name'),

				'id'							=> $this->validation('name'),
				'password' 						=> $this->validation('password'),
				'confirm_password'				=> $this->validation('c_password')
			];
			$validator = \Validator::make($this->data->all(), $validations,[
			]);
			if(!empty($this->data->otp)){

    		$userDetails = User::where(['otp'=> $this->data->otp,'id'=>___decrypt($this->data->id)])->first();
    		
		    $validator->after(function ($validator) use($userDetails) {
		    	if(empty($userDetails)){
		    		$validator->errors()->add('otp', 'Invalid OTP.Please enter correct OTP.');
		    	}        
		    });
    	}
		}
		
		return $validator;
	}

	public function resetPassword(){
		if($this->data->web =='web'){
			$validations = [
			
			'user_id'							=> $this->validation('name'),
        	'password' 						=> $this->validation('password'),
        	'confirm_password'				=> $this->validation('c_password')
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[
			
		]);
    	
		}else{

			$validations = [
				

				'user_id'							=> $this->validation('name'),
				'password' 						=> $this->validation('password'),
				'confirm_password'				=> $this->validation('c_password')
			];
			$validator = \Validator::make($this->data->all(), $validations,[
			]);
		
		}
		
		return $validator;
	}

	public function signup()
	{

		if($this->data->type=="user"){
			$validations = [
				'first_name'					=> $this->validation('name'),
	        	'last_name' 					=> $this->validation('name'),
	        	'child_name'					=> $this->validation('child'),
	        	'child_name.*'					=> $this->validation('child_details'),
	        	'child_age'						=> $this->validation('child'),
	        	'child_age.*'					=> $this->validation('child_details'),
	        	'child_gender'					=> $this->validation('child'),
	        	'child_gender.*'				=> $this->validation('child_details'),
	        	'mobile'						=> $this->validation('mobile_number'),
	        	/*'otp'							=> $this->validation('name'),*/
	        	'address'						=> $this->validation('address'),
	        	'country'						=> $this->validation('name'),
	        	'state'							=> $this->validation('name'),
	        	'city'							=> $this->validation('name'),
	        	'password' 						=> $this->validation('password'),
	        	'confirm_password'				=> $this->validation('c_password'),
	        	/*'term_condition'				=> $this->validation('name')*/
	    	];
		}else{
			$validations = [
				'first_name'					=> $this->validation('name'),
	        	'last_name' 					=> $this->validation('name'),
	        	'mobile'						=> $this->validation('mobile_number'),
	        	'email'							=> $this->validation('email'),
	        	'date_of_birth' 				=> $this->validation('name'),
	        	'address'				        => $this->validation('address'),
	        	'country'						=> $this->validation('name'),
	        	'state'							=> $this->validation('name'),
	        	'city'							=> $this->validation('name'),
	        	'gender'							=> $this->validation('name'),
	        	/*'bank_name'						=> $this->validation('name'),
	        	'bank_account_number'			=> $this->validation('name'),
	        	'bank_holder_name'				=> $this->validation('name'),
	        	'bank_ifsc_code'				=> $this->validation('name'),
	        	'bank_branch_name'				=> $this->validation('name'),*/
	        	/*'day_of_service'				=> $this->validation('name'),
	        	'service_start_time'			=> $this->validation('name'),
	        	'service_end_time'				=> $this->validation('name'),
	        	'special_service'				=> $this->validation('name'),
	        	'distance_travel'				=> $this->validation('name'),
	        	'long_distance_travel'			=> $this->validation('name'),
	        	'location_track_permission'		=> $this->validation('name'),*/

	        	/*'service_id'					=>$this->validation('name'),
				'price_per_hour'				=>$this->validation('name'),
				'price_per_children'			=>$this->validation('name'),
				'experience_in_work'			=>$this->validation('name'),*/
				
	        	'document_high_school'			=> $this->validation('doc_file_any'),
	        	'document_graduation'			=> $this->validation('doc_file_any'),
	        	'document_post_graduation'		=> $this->validation('doc_file_any'),
	        	'document_adhar_card'			=> $this->validation('doc_file_any'),
	        	'document_other'				=> $this->validation('doc_file_any'),
	        /*	'photo'							=> $this->validation('photomimes'),
	        	'video'							=> $this->validation('video'),*/
	        	'password' 						=> $this->validation('password'),
	        	'confirm_password'				=> $this->validation('c_password'),
	        	'term_condition'				=> $this->validation('name')

	    	];

		}
    	$validator = \Validator::make($this->data->all(), $validations,[
    		'country.required' 						=>  'Region is required.'
    	]);
		if(!empty($this->data->mobile)){
			$userDetails = User::where('mobile',$this->data->mobile)->first();
		    $validator->after(function ($validator) use($userDetails) {
		    	if(!empty($userDetails)){
		    		$validator->errors()->add('mobile', 'Mobile Number Already Exist.');
		    	}        
		    });
		}
		if(!empty($this->data->email)){
			$userDetails = User::where('email',$this->data->email)->first();
		    $validator->after(function ($validator) use($userDetails) {
		    	if(!empty($userDetails)){
		    		$validator->errors()->add('email', 'E-mail Already Exist.');
		    	}        
		    });
		}

		/*if($this->data->type=='user'){

			if(empty($this->data->child_name[0])){
				

			    $validator->after(function ($validator){
			    	
			    	$validator->errors()->add('child_name[0]', 'Child Name is required');
			    	      
			    });
			}
			if(empty($this->data->child_age[0])){

			    $validator->after(function ($validator){
			    	
			    	$validator->errors()->add('child_age[0]', 'Child Age is required');
			    	      
			    });
			}
			if(empty($this->data->child_gender[0])){

			    $validator->after(function ($validator){
			    	
			    	$validator->errors()->add('child_gender[0]', 'Child Gender is required');
			    	      
			    });
			}
		}*/
		return $validator;
	}

	public function signupByAdmin($action="add")
	{

		if($this->data->type=="user"){
			$validations = [
				'first_name'					=> $this->validation('name'),
	        	'last_name' 					=> $this->validation('name'),
	        	'child_name'					=> $this->validation('child'),
	        	'child_name.*'					=> $this->validation('child_details'),
	        	'child_age'						=> $this->validation('child'),
	        	'child_age.*'					=> $this->validation('child_details'),
	        	'child_gender'					=> $this->validation('child'),
	        	'child_gender.*'				=> $this->validation('child_details'),
	        	'mobile'						=> $this->validation('mobile_number'),
	        	/*'otp'							=> $this->validation('name'),*/
	        	'address'						=> $this->validation('address'),
	        	'country'						=> $this->validation('name'),
	        	'state'							=> $this->validation('name'),
	        	'city'							=> $this->validation('name'),
	        	'password' 						=> $this->validation('password'),
	        	'confirm_password'				=> $this->validation('c_password'),
	        	/*'term_condition'				=> $this->validation('name')*/
	    	];
		}else{
			$validations = [
				'first_name'					=> $this->validation('name'),
	        	'last_name' 					=> $this->validation('name'),
	        	'mobile'						=>array_merge($this->validation('mobile_number'),[Rule::unique('users')]),
	        	'email'							=> array_merge($this->validation('email'),[Rule::unique('users')]),
	        	'date_of_birth' 				=> $this->validation('name'),
	        	'address'				        => $this->validation('address'),
	        	'country'						=> $this->validation('name'),
	        	'state'							=> $this->validation('name'),
	        	'city'							=> $this->validation('name'),
	        	'permanent_address'				=> $this->validation('address'),
	        	'permanent_country'				=> $this->validation('gallery_null'),
	        	'permanent_state'				=> $this->validation('gallery_null'),
	        	'permanent_city'				=> $this->validation('gallery_null'),
	        	'password' 						=> $this->validation('password'),
	        	'confirm_password'				=> $this->validation('c_password'),
	        	/*'bank_name'						=> $this->validation('name'),
	        	'bank_account_number'			=> $this->validation('name'),
	        	'bank_holder_name'				=> $this->validation('name'),
	        	'bank_ifsc_code'				=> $this->validation('name'),
	        	'bank_branch_name'				=> $this->validation('name'),*/
	        	/*'day_of_service'				=> $this->validation('name'),
	        	'service_start_time'			=> $this->validation('name'),
	        	'service_end_time'				=> $this->validation('name'),
	        	'special_service'				=> $this->validation('name'),
	        	'distance_travel'				=> $this->validation('name'),
	        	'long_distance_travel'			=> $this->validation('name'),
	        	'location_track_permission'		=> $this->validation('name'),*/

	        	/*'service_id'					=>$this->validation('name'),
				'price_per_hour'				=>$this->validation('name'),
				'price_per_children'			=>$this->validation('name'),
				'experience_in_work'			=>$this->validation('name'),*/
				
	        	
	        	/*'term_condition'				=> $this->validation('name')*/

	    	];

		}
    	
    	if($action=='edit'){
    	
    		$validations['password']='';
    		$validations['confirm_password']='';
			$validations['mobile'] = array_merge($this->validation('mobile_number'),[
				Rule::unique('users')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
			$validations['email'] = array_merge($this->validation('email'),[
				Rule::unique('users')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
		}

		$validator = \Validator::make($this->data->all(), $validations,[
    		'country.required' 						=>  'Region is required.'
    	]);

		/*if(!empty($this->data->mobile)){
			$userDetails = User::where('mobile',$this->data->mobile)->first();
		    $validator->after(function ($validator) use($userDetails) {
		    	if(!empty($userDetails)){
		    		$validator->errors()->add('mobile', 'Mobile Number Already Exist.');
		    	}        
		    });
		}
		if(!empty($this->data->email)){
			$userDetails = User::where('email',$this->data->email)->first();
		    $validator->after(function ($validator) use($userDetails) {
		    	if(!empty($userDetails)){
		    		$validator->errors()->add('email', 'E-mail Already Exist.');
		    	}        
		    });
		}*/

		return $validator;
	}
	public function bankDetail()
	{
		
			$validations = [
				'user_id'						=> $this->validation('id'),
	        	'bank_name'						=> $this->validation('name'),
	        	'bank_account_number'			=> $this->validation('name'),
	        	'bank_holder_name'				=> $this->validation('name'),
	        	'bank_ifsc_code'				=> $this->validation('name'),
	        
	    	];

		
    	$validator = \Validator::make($this->data->all(), $validations,[
    	]);
		
		return $validator;
	}

	public function addServiceDays()
	{
		
			$validations = [
				'service_id'						=> $this->validation('id'),
	        	'provider_id'						=> $this->validation('id'),
	        	'day'			=> $this->validation('mobile_number'),
	        	'start_time'				=> $this->validation('name'),
	        	'end_time'				=> $this->validation('name'),
	        
	    	];

		
    	$validator = \Validator::make($this->data->all(), $validations,[
    	]);
		
		return $validator;
	}

	
	public function qualificationDetail()
	{
		
			$validations = [
				'user_id'						=> $this->validation('id'),
	        	'highschool_year'				=> $this->validation('name'),
	        	'intermediate_year'				=> $this->validation('name'),
	        	'graduation_year'				=> $this->validation('name'),
	        	'post_graduation_year'			=> $this->validation('name'),
	        
	    	];

		
    	$validator = \Validator::make($this->data->all(), $validations,[
    	]);
		
		return $validator;
	}
	
	public function updateAddress()
	{
		
			$validations = [
				'user_id'						=> $this->validation('id'),
	        	'current_address'				=> $this->validation('address'),
	        	'current_country'				=> $this->validation('address'),
	        	'current_state'				    => $this->validation('address'),
	        	'current_city'				    => $this->validation('address'),
	        	'permanent_address'				=> $this->validation('address'),
	        	'permanent_country'			    => $this->validation('id'),
	        	'permanent_state'				=> $this->validation('id'),
	        	'permanent_city'				=> $this->validation('id'),
	        
	    	];

		
    	$validator = \Validator::make($this->data->all(), $validations,[
    	]);
		
		return $validator;
	}

	public function faq()
	{
		
			$validations = [
				'question'						=> $this->validation('qualifications'),
	        	
	    	];

		
    	$validator = \Validator::make($this->data->all(), $validations,[
    	]);
		
		return $validator;
	}

	public function feedback()
	{
		
			$validations = [
				'feedback'						=> $this->validation('qualifications'),
				'user_id'						=> $this->validation('id'),
	        	
	    	];

		
    	$validator = \Validator::make($this->data->all(), $validations,[
    	]);
		
		return $validator;
	}



	public function addDocuments()
	{
		
			$validations = [
				'user_id'						=> $this->validation('id'),
	        	'document_high_school'			=> $this->validation('doc_file_any'),
	        	'document_graduation'			=> $this->validation('doc_file_any'),
	        	'document_post_graduation'		=> $this->validation('doc_file_any'),
	        	'document_adhar_card'			=> $this->validation('doc_file_any'),
	        	'document_other'				=> $this->validation('doc_file_any'),
	        
	    	];

		
    	$validator = \Validator::make($this->data->all(), $validations,[
    	]);
		
		return $validator;
	}

	public function addQualification()
	{
		$validations = [
			'user_id'						=> $this->validation('id'),
    	];
    	
    	$validator = \Validator::make($this->data->all(), $validations,[
    	]);
		
		return $validator;
	}

	public function verifyEmailPhone(){
		if(is_numeric($this->data->username)){
			$validations = [
			'username' 						=> $this->validation('mobile_number')
			];
			$validator = \Validator::make($this->data->all(), $validations,[
			'username.required' 						=>  'Mobile number is required.',
			'username.numeric' 						    =>  'The Mobile Number must be a numeric.'
			]);
			if(!empty($this->data->username)){
	    		$userDetails = User::where('mobile',$this->data->username)->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('username', 'No Account Found With This Mobile Number.');
			    	}        
			    });
    		}
		}else{
			$validations = [
	        	'username' 						=> $this->validation('req_email')
	    	];
	    	$validator = \Validator::make($this->data->all(), $validations,[
				'username.required' 						=>  'E-mail is required.',
				'username.email' 						    =>  'The email must be a valid email address.'
			]);
			if(!empty($this->data->username)){
	    		$userDetails = User::where('email',$this->data->username)->first();
			    $validator->after(function ($validator) use($userDetails) {
			    	if(empty($userDetails)){
			    		$validator->errors()->add('username', 'No Account Found With This Email.');
			    	}        
			    });
    		}
		}
		return $validator;
	}
}