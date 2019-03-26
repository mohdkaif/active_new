<?php
namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class SubCategoryValidation{
	protected $data;
	public function __construct($data){
		$this->data = $data;
	}


	public function createSubCategory(){
		$validations = [
            'service_category_name'      => ['required'],
            'service_sub_category_name'  => ['required','unique:service_sub_category'],
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
            'service_category_name.required'       => 'Please Select Service Category.' ,
            'service_sub_category_name.required'   => 'Please Enter Sub Category Name.',
            'service_sub_category_name.unique'     => 'Sub Category Already Exist.'



        ]);
        return $validator;	
	}

	public function updateSubCategory(){
		$validations = [
            'service_category_name'      => ['required'],
            'service_sub_category_name'  => ['required',Rule::unique('service_sub_category')->ignore($this->data->id,'service_sub_category_id')],
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
            'service_category_name.required'       => 'Please Select Service Category.' ,
            'service_sub_category_name.required'   => 'Please Enter Sub Category Name.',
            'service_sub_category_name.unique'     => 'Sub Category Already Exist.'


        ]);
        return $validator;	
	}


}