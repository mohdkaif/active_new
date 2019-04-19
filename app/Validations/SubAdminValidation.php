<?php
namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class SubAdminValidation{
	protected $data;
	public function __construct($data){
		$this->data = $data;
	}


	public function add(){
		$validations = [
            'image'                  => ['nullable','image','mimes:jpeg,bmp,png,jpg'],
            'first_name'             => ['required'],
            'last_name'              => ['required'],
            'phone_number'           => ['required','regex:'.MOBILE_FORMAT,'unique:users,mobile'],
            'email'                  => ['required','email','unique:users,email'],
            'date_of_birth'          => ['nullable'],
            'gender'                 => ['required',Rule::in(['male','female'])],
            'country'                => ['required'],
            'state'                  => ['required'],
            'city'                   => ['required'],
            'address'                => ['required'],
            'permanent_country'      => ['required'],
            'permanent_state'        => ['required'],
            'permanent_city'         => ['required'],
            'permanent_address'      => ['required'],
            'password'               => ['required','min:6'],
            'confirm'                => ['same:password']

    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[]);
        return $validator;	
	}

	public function edit(){
		$validations = [
            'image'                  => ['nullable','image','mimes:jpeg,bmp,png,jpg'],
            'first_name'             => ['required'],
            'last_name'              => ['required'],
            'phone_number'           => ['required','regex:'.MOBILE_FORMAT,'unique:users,mobile,'.$this->data->id],
            'email'                  => ['required','email','unique:users,email,'.$this->data->id],
            'date_of_birth'          => ['nullable'],
            'gender'                 => ['required',Rule::in(['male','female'])],
            'country'                => ['required'],
            'state'                  => ['required'],
            'city'                   => ['required'],
            'address'                => ['required'],
            'permanent_country'      => ['required'],
            'permanent_state'        => ['required'],
            'permanent_city'         => ['required'],
            'permanent_address'      => ['required'],
        ];
    	
        $validator = \Validator::make($this->data->all(), $validations,[]);
        return $validator;	
	}


    public function resetpassword(){
        $validations = [
            'password'               => ['required','min:6'],
            'confirm'                => ['same:password']
        ];
        
        $validator = \Validator::make($this->data->all(), $validations,[
        'password.required' => 'Please Enter New Password.',
        'password.min'      => 'Password Should Be Min 6 Character Long.',
        'confirm.same'      => 'Password & Re-Enter Password Should Be Same.',  

        ]);
        return $validator;  



    }


}