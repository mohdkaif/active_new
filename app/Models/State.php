<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [

        'country_id', 'state_name','status'
    ];
    public function country(){
         return $this->belongsTo('App\Models\Country');
    }

    public function cities(){
        return $this->hasMany('App\Models\City');
    }

    public function userDetails(){
        return $this->hasMany('App\Models\UserDetail');
    }  

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc'){
                
        $table_course = self::select($keys)
        ->with([
            'country' => function($q) {
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
