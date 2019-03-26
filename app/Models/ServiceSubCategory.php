<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceSubCategory extends Model
{

    use SoftDeletes;

    protected $table      = 'service_sub_category';
    protected $primaryKey = 'service_sub_category_id';

    public function category(){
        return $this->hasOne('Models\ServiceCategory', 'service_category_id', 'service_category_id');
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
        $table_users = DB::table('service_sub_category');
        if(!empty($data)){
            $table_users->where('service_sub_category_id','=',$userID);
            if (!empty($where)) {
                $table_users->whereRaw($where);
            }
            $isUpdated = $table_users->update($data); 
        }
        return (bool)$isUpdated;
    }


    public static function listing($type='array',$keys='*',$where='',$order_by='service_sub_category_id-desc',$limit=10){
        $table_name = self::select($keys)->with(['category' => function($q){
            $q->select('*');
        }]);
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

    public static function updateStatus($id,$data){
        $isUpdated = false;
        if(!empty($data)){
            $table_name=self::where('service_sub_category_id',$id);
            $isUpdated = $table_name->update($data); 
        }       
        return (bool)$isUpdated;
    }
}
