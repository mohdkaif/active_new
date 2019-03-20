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


    public function provider_user(){
        return $this->hasOne('\App\Models\ProviderUser','user_id','id');
    }  

    public function state_details(){
        return $this->hasOne('\App\Models\State','id','state');
    } 

     public function city_details(){
        return $this->hasOne('\App\Models\City','id','city');
    } 
    

     public static function provider_list($fetch='array',$where='',$keys=['*'],$order='id-desc'){
                
        $table_course = self::select($keys)
        ->with([
            'provider_user' => function($q) {
                $q->select('*');
                
            },
            'state_details' => function($q) {
                $q->select('*');
                
            },
            'city_details' => function($q) {
                $q->select('*');
                
            }
        ]);

        if($where){
            $table_course->whereRaw($where);
        }
        
        //$userlist['userCount'] = !empty($table_user->count())?$table_user->count():0;
        
        if(!empty($order)){
            $order = explode('-', $order);
            $table_course->orderBy($order[0],$order[1]);
        }
        if($fetch === 'array'){
            $list = $table_course->get();
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_course->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_course->get()->first();
        }else if($fetch === 'count'){
            return $table_course->get()->count();
        }else{
            return $table_course->limit($limit)->get();
        }
    }

     public static function change($userID,$data){
        $isUpdated = false;
        $table_course = \DB::table('users');
        if(!empty($data)){
            $table_course->where('id','=',$userID);
            $isUpdated = $table_course->update($data); 
        }
                
        return (bool)$isUpdated;
    }
    
   
}
