<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class UserChild extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "user_child";
    protected $fillable = [
        'user_id','name','gender','age','status','created_at','updated_at'
    ];

   
}
