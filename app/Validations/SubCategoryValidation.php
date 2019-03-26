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


	public function createCategory(){
		$validations = [
            'service_category_name'  => ['required','unique:service_category'],
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
            'service_category_name.required'   => 'Please Enter Category Name.',
            'service_category_name.unique'     => 'Category Already Exist.'



        ]);
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