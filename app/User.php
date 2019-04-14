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
        'token','lat','lng','device_id','user_type','first_name', 'last_name','email', 'password','date_of_birth','is_email_verified','is_mobile_verified','image','mobile','otp','address','country','city','state','remember_token','status','permanent_address','permanent_country','permanent_city','permanent_state',
        'pincode','permanent_pincode','facebook_id','google_id','gender'
    ];


    public function provider_user(){
        return $this->hasOne('\App\Models\ProviderUser','user_id','id');
    }  

    public function state_details(){
        return $this->hasOne('\App\Models\State','id','permanent_state');
    } 

     public function city_details(){
        return $this->hasOne('\App\Models\City','id','permanent_city');
    } 

    public function country_details(){
        return $this->hasOne('\App\Models\Country','id','permanent_country');
    } 

    /*public function service(){
        return $this->hasMany('\App\Models\Service','provider_id','service_id');
    } */
    

     public static function provider_list($fetch='array',$where='',$keys=['*'],$order='id-desc'){
                 

                 $thumb_asset = asset('/assets/document/');
        $table_course = self::select($keys)
        ->with([
            'provider_user' => function($q) use($thumb_asset){
                $q->select('*',\DB::RAW("CONCAT('{$thumb_asset}/',document_high_school) as 'document_high_school_file'"),\DB::RAW("CONCAT('{$thumb_asset}/',document_graduation) as 'document_graduation_file'"),\DB::RAW("CONCAT('{$thumb_asset}/',document_post_graduation) as 'document_post_graduation_file'"),\DB::RAW("CONCAT('{$thumb_asset}/',document_adhar_card) as 'document_adhar_card_file'"),\DB::RAW("CONCAT('{$thumb_asset}/',document_other) as 'document_other_file'"));
                
            },
            'state_details' => function($q) {
                $q->select('*');
                
            },
            'city_details' => function($q) {
                $q->select('*');
                
            },
            'country_details' => function($q) {
                $q->select('*');
                
            },
            /*'service' => function($q) {
                $q->select('*');
                
            }*/
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

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc'){
                
        $table_course = self::select($keys)
        ->with([
            
            'state_details' => function($q) {
                $q->select('*');
                
            },
            'city_details' => function($q) {
                $q->select('*');
                
            },
            'country_details' => function($q) {
                $q->select('*');
                
            },
            /*'service' => function($q) {
                $q->select('*');
                
            }*/
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


    public static function updateStatus($id,$data){
        $isUpdated = false;
        if(!empty($data)){
            $table_name=self::where('id',$id);
            $isUpdated = $table_name->update($data); 
        }       
        return (bool)$isUpdated;
    }
    
   
}
