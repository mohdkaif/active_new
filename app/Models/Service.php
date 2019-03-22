<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service_sub_category';

    protected $fillable = [ 'service_sub_category_id', 'service_category_id','service_sub_category_name'
    ];
    
}
?>