<?php

namespace App\Models;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class SubscriptionProvider extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "subscription_provider";
    protected $fillable = ['id','user_id','subscription_id','provider_id','date','time','price','order_number','tracking_id','txn_id','payment_status','payment_mode'
    ];

    public function subscription(){
        return $this->hasOne('App\Models\Subscription', 'id', 'subscription_id');
    }
 

   

     public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc'){
                
        $table_course = self::select($keys)
        ->with(['subscription' => function($q){
            $q->select('*');
        }]);

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
