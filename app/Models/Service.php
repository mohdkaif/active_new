<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = ['id',	'service_category_id',	'service_sub_category_id',	'provider_id',	'days_for_service',	'service_start_time',	'service_end_time',	'special_day',	'price_per_hour'	,'price_per_children',	'experience_in_work',	'photo',	'video',	'status',	'created_at',	'updated_at',

    ];

     public function service_days(){
        return $this->hasMany('App\Models\ServiceDays', 'service_id', 'id');
    }

    public function service_category(){
        return $this->hasOne('App\Models\ServiceCategory', 'service_category_id', 'service_category_id');
    }


    public function service_sub_category(){
            return $this->hasOne('App\Models\ServiceSubCategory', 'service_sub_category_id', 'service_sub_category_id');
        }



     public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc'){
                
        $table_course = self::select($keys)
        ->with([
            'service_days' => function($q) {
                $q->select('*');
                
            },
            'service_category' => function($q) {
                $q->select('*');
                
            },
            'service_sub_category' => function($q) {
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