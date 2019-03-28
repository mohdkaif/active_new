<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceDays extends Model
{
    protected $table = 'service_days';

    protected $fillable = ['id',	'service_id', 'provider_id',	'day',	'start_time',	'end_time','created_at',	'updated_at'

    ];

    public function service(){
        return $this->hasOne('App\Models\Service', 'id', 'service_id');
    }

    public function provider(){
        return $this->hasOne('App\Models\ProviderUser', 'id', 'provider_id');
    }

    public static function list($type='array',$keys='*',$where='',$order_by='service_category_id-desc',$limit=10){
        $table_name = self::select($keys)->where('status','!=','trashed')
        ->with([
            'service' => function($q) {
                $q->select('*');
                
            },
            'provider' => function($q) {
                $q->select('*');
                
            }
        ]);  
        if($where){
            $table_name->whereRaw($where);
        }

        if(!empty($order_by)){
            $order_by = explode('-', $order_by);
            $table_name->orderBy($order_by[0],$order_by[1]);
        }

        if($type === 'array'){
            $list = $table_name->get();
            return json_decode(json_encode($list), true );
        }else if($type === 'obj'){
            return $table_name->limit($limit)->get();                
        }else if($type === 'single'){
            return $table_name->get()->first();
        }else{
            return $table_name->limit($limit)->get();
        }
    }

     public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

     public static function change($userID,$data, $where=""){
        $isUpdated = false;
        $table_users = \DB::table('service_days');
        if(!empty($data)){
            $table_users->where('id','=',$userID);
            if (!empty($where)) {
                $table_users->whereRaw($where);
            }
            $isUpdated = $table_users->update($data); 
        }
        return (bool)$isUpdated;
    }
    
}
?>