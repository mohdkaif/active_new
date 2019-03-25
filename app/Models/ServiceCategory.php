<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceCategory extends Model
{
    protected $table = 'service_category';
    protected $primaryKey = 'service_category_id';


    public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

     public static function change($userID,$data, $where=""){
        $isUpdated = false;
        $table_users = DB::table('categories');
        if(!empty($data)){
            $table_users->where('id','=',$userID);
            if (!empty($where)) {
                $table_users->whereRaw($where);
            }
            $isUpdated = $table_users->update($data); 
        }
        return (bool)$isUpdated;
    }

    public static function list($fetch='array',$id=NULL,$where='',$order='id-desc',$limit=10){
        $table_user = self::select(['id','category_name','is_promotional','status',
            DB::raw('IF(categories.category_image IS NULL OR categories.category_image="","'.asset(DEFAULT_CATEGORY).'",CONCAT("'.asset('images/category').'","/",categories.category_image)) AS categoryImage')]);
        if($where){
            $table_user->whereRaw($where);
        }
        if(!empty($id)){
            $table_user->where(['id' => $id]);
        }
      
        if(!empty($order)){
            $order = explode('-', $order);
            $table_user->orderBy($order[0],$order[1]);
        }
        if($fetch === 'array'){
            $userlist = $table_user->get();
            return json_decode(json_encode($userlist ), true );
        }else if($fetch === 'obj'){
            return $table_user->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_user->get()->first();
        }else{
            return $table_user->limit($limit)->get();
        }
    }

      public static function listing($type='array',$keys='*',$where='',$order_by='id-desc',$limit=10){
        $table_name = self::select($keys)->where('status','!=','trashed');
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
            $table_name=self::where('id',$id);
            $isUpdated = $table_name->update($data); 
        }       
        return (bool)$isUpdated;
    }
}
