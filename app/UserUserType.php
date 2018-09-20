<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserUserType extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='user_user_type';
    
    protected $fillable = [
        'user_id','user_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public static $usertype_attach_rules = [
    'usertypes' => 'required|array|min:1|exists:usertypes,id'
    ];

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function usertype(){
        return $this->hasOne('App\UserType','id','user_type_id');
    }


}