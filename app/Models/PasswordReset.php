<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{	
	protected $fillable = ['email' , ' created_at' , 'token'];
	public $timestamps = false;

	public static function listing($type='array',$keys='*',$where='',$order_by='',$limit=10){
	    $table_name = self::select($keys);

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

		public static function manage($key,$value,$data){
		$responce     = "";
		$isfound      = self::findByKey($key,$value);
		if($isfound){
			$responce = self::updateRecords($key,$value,$data);
		}else{
			$responce = self::insertRecord($key,$value,$data);
		}
		return $responce;
	}



		public static function updateRecords($key,$value,$data){
            $table_name=self::where($key,$value)->update($data);
            if($table_name){
            	$token = self::select('token')->where($key, $value)->first();
            	return $token;
            }
           
     
	   }

		public static function insertRecord($key,$value,$data){
			$save = self::insert($data);
			if($save){
				$token = self::select('token')->where($key, $value)->first();
				return $token;
			}
		}


		public static function findByKey($key,$value){
			$find = self::where($key,$value)->first();
			return $find;


	}

		public static function delete_entry($key,$value){
			$delete = false;
			if(! empty($key) && ! empty($value)){
			   $delete = self::where($key,$value)->delete();
			}
			return (bool)$delete;
	}
}
