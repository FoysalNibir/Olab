<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class UserType extends Model{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='user_types';
    protected $fillable = [
        'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public static $rules = [
    'type' => 'required'
    ];

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function permissions(){
        return $this->hasMany('App\PermissionUserType', 'user_type_id', 'id' );
    }

    public function userusertype(){
        return $this->hasOne('App\UserUserType','user_type_id','id');
    }

}
