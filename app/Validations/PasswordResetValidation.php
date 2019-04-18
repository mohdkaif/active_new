<?php 
namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;


class PasswordResetValidation{

	protected $data;
	public function __construct($data){
		$this->data = $data;
	}


	public function passwordreset(){

		$validate = Validator::make($this->data->all(), [
			'email' 			   	=> ['required','email','exists:users,email'],
		],[
			'email.required' 		=> "Please Enter Email.",
			'email.email'			=> "Please Enter Valid Email.",
			'email.exists'			=> "Account Not Registred With Us.",

		]);

		return $validate;


	}


	public function updatepassword(){
	$validate = Validator::make($this->data->all(),[
	'password'			=> ['required','min:6'],
	'repassword'		=> ['required','same:password'],

	],[

	'password.required'						=> 'Please Enter Password',
	'password.min'						    => "Password Must Be At Least 6 characters  long.",
	'repassword.required'					=> "Please Re-Enter Password.",
	'repassword.same'						=> "Password & Re-password Not Matched.",


	]);
	return $validate;

}



	public function associatelogin($request){
			$validation['email']	= ['required',Rule::exists('users')->where(function ($query)use($request){
            $query->where('user_type', $request->user_type);
        })];
			$validation['password']	    = ['required'];
			$validation['user_type']	= ['required',Rule::in(['franchise','collection_centre','recharge_centre'])];
			$validate = Validator::make($this->data->all(),$validation,[
			'email.required' 		=> "Please Enter Email Or Mobile.",
			'email.email'			=> "Please Enter Valid Email.",
			'email.exists'			=> "Account Not Registred With Us.",
			'password.required'	    => "Please Enter Password",

		]);
		return $validate;


	}



}


?>