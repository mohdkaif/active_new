<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token','lat','lng','device_id','user_type','first_name', 'last_name','email', 'password','is_email_verified','is_mobile_verified','mobile','otp','address','region','city','state','remember_token','status'
    ];
    
   
}
