<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Booking extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "booking";
    protected $fillable = [
        'id',  'user_id', 'service_id',  'provider_id', 'date',    'time',    'price',   'booking_number',  'tracking_id', 'txn_id',  'payment_status',  'payment_mode',  'booking_status'
    ];

    public function user_details(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function service_details(){
        return $this->hasOne('App\Models\Service', 'id', 'service_id');
    }
 

   

     public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc'){
                
        $table_course = self::select($keys)
        ->with([
            'user_details' => function($q){
                $q->select('*');
            },
            'service_details' => function($q){
                $q->select('*');
            },

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

   
   
}
