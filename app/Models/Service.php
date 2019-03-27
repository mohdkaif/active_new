<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = ['id',	'service_category_id',	'service_sub_category_id',	'provider_id',	'days_for_service',	'service_start_time',	'service_end_time',	'special_day',	'price_per_hour'	,'price_per_children',	'experience_in_work',	'photo',	'video',	'status',	'created_at',	'updated_at',

    ];

     public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

     public static function change($userID,$data, $where=""){
        $isUpdated = false;
        $table_users = \DB::table('services');
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