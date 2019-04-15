<?php
namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class SubscriptionValidation{
	protected $data;
	public function __construct($data){
		$this->data = $data;
	}


	public function add(){
		$validations = [
            'name'                   => ['required','unique:subscriptions'],
            'description'            => ['nullable'],
            'months'                 => ['required','numeric'],
            'price'                  => ['required','numeric'],   
    	];
        $validator = \Validator::make($this->data->all(), $validations,[]);
        return $validator;	
	}

	public function edit(){
		$validations = [
            'name'                   => ['required','unique:subscriptions,name,'.$this->data->id],
            'description'            => ['nullable'],
            'months'                 => ['required','numeric'],
            'price'                  => ['required','numeric'],   
        ];
    	
        $validator = \Validator::make($this->data->all(), $validations,[]);
        return $validator;	
	}


}