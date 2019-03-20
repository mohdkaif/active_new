<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [

		'country_code', 'country_name','status'
	];
	
    public function userDetails(){
        return $this->hasMany('App\Model\UserDetail');
    } 
    public function states(){
        return $this->hasMany('App\Models\State');
    } 

    public function countryByCountryCode($code) {
    	// dd($code);
    	return Country::where("country_code",'=',$code)->first();
    }  

}
