<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ProviderUser extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "provider_user";
    protected $fillable = [
        'user_id','bank_name','bank_account_number','bank_holder_name','bank_ifsc_code', 'day_for_service', 'service_start_time','service_end_time','special_service','distance_to_travel','long_distance_travel','location_track_permission','term_condition','document_high_school','document_graduation','document_post_graduation','document_addhar_card','document_other','status','created_at','updated_at'
    ];
   
}
