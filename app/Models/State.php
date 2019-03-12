<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [

        'country_id', 'state_name','status'
    ];
    public function country(){
         return $this->belongsTo('App\Models\Country');
    }

    public function cities(){
        return $this->hasMany('App\Models\City');
    }

    public function userDetails(){
        return $this->hasMany('App\Models\UserDetail');
    }    
}
