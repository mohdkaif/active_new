<?php
namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class CategoryValidation{
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
            'banner_title' 		 => ['required'],
            'banner_description' => ['required'],
            'banner_city'	     => ['required','numeric'],
            'banner_order'       => ['required','numeric','min:1'],
            'banner_image' 	     => ['nullable','mimes:jpeg,png,jpg,gif,svg'],

    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[]);
        return $validator;	
	}


}