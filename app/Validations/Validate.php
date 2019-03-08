<?php

namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
Use App\User;
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
			'phone' 	        	=> ['required','string','numeric'],
			'course' 	        	=> ['required','string'],
			'location' 	        	=> ['required','string'],
			'comments' 	        	=> ['required','string'],
			'password'          	=> ['required','string','max:50'],
			'c_password'          	=> ['required','same:password'],
			'price'					=> ['required','numeric'],
			'start_from'			=> ['required'],
			'photo'					=> ['required','mimes:jpg,jpeg,png','max:2408'],
			'photomimes'			=> ['mimes:jpg,jpeg,png','max:2408'],
			'photo_null'			=> ['nullable'],
			'gallery'				=> ['required','mimes:jpg,jpeg,png','max:2048'],
			'gallery_null'			=> ['nullable'],
			'url' 				    => ['required','url'],
			'slug_no_space'		    => ['required','alpha_dash','max:255'],
			'password_check'	    => ['required'],
			'file'					=> ['required','mimes:pdf'],
			'newpassword'		    => ['required','max:10']	

		];
		return $validation[$key];
	}
	public function login(){
		if(is_numeric($this->data->username)){
			 $validations = [
            'username' 		       => $this->validation('mobile_number'),
			'password'       	   => $this->validation('password'),
    	];
    }else{

        $validations = [
            'username' 		       => $this->validation('req_email'),
			'password'       	   => $this->validation('password'),
    	];
    }
        $validator = \Validator::make($this->data->all(), $validations,[]);
        return $validator;		
	}

	

	public function forgotpass(){
		$validations = [
        	'email' 						=> $this->validation('req_email')
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[
			'email.required' 						=>  'E-mail is required.',
			'email.email' 						    =>  'The email must be a valid email address.'
		]);

		if(!empty($this->data->email)){
    		$userDetails = User::where('email',$this->data->email)->first();
		    $validator->after(function ($validator) use($userDetails) {
		    	if(empty($userDetails)){
		    		$validator->errors()->add('email', 'No Account Found With This Email.');
		    	}        
		    });
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

	public function changePassword(){
		$validations = [
			'id'							=> $this->validation('name'),
        	'password' 						=> $this->validation('password'),
        	'confirm_password'				=> $this->validation('c_password')
        	
    	];
    	$validator = \Validator::make($this->data->all(), $validations,[
			
		]);
		
		return $validator;
	}
}