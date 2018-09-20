<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'usertokens';

    protected $fillable = [
        'user_id', 'usertoken'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public static $rules = [
    'user_id' => 'required|exists:users,id|unique:user_tokens',
    'user_token' => 'required|unique:user_tokens'
    ];

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

}