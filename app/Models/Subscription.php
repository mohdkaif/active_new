<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Subscription extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "subscriptions";
    protected $fillable = [
       'id',   'name',    'description', 'price',   'months',  'status',  'created_at',  'updated_at'

    ];

    
     public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc'){
                
        $table_course = self::select($keys)->where('status','!=','trashed');

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

    public static function updateStatus($id,$data){
        $isUpdated = false;
        if(!empty($data)){
            $table_name=self::where('id',$id);
            $isUpdated = $table_name->update($data); 
        }       
        return (bool)$isUpdated;
    } 

   
   
}
