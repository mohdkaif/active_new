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
            'image'                  => ['required','image','mimes:jpeg,bmp,png,jpg'],
            'first_name'             => ['required'],
            'last_name'              => ['required'],
            'phone_number'           => ['required','regex:'.MOBILE_FORMAT,'unique:users,mobile'],
            'email'                  => ['required','email','unique:users,email'],
            'date_of_birth'          => ['nullable'],
            'gender'                 => ['required',Rule::in(['male','female'])],
            'country'                => ['required'],
            'state'                  => ['required'],
            'city'                   => ['required'],
            'permanent_country'      => ['required'],
            'permanent_state'        => ['required'],
            'permanent_city'         => ['required'],

    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[]);
        return $validator;	
	}

	public function updateCategory(){
		$validations = [
            'service_category_name'  => ['required',Rule::unique('service_category')->ignore($this->data->id, 'service_category_id')],
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
            'service_category_name.required'   => 'Please Enter Category Name.',
            'service_category_name.unique'     => 'Category Already Exist.'


        ]);
        return $validator;	
	}


}