<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

use App\Coupon;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone', 'password', 'age', 'sex', 'email', 'picture', 'address', 'blood_group', 'name', 'isactive'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public static $auth_rules = [
        'phone' => ['required', 'regex:/(^[+]{1}[8]{2}[01]{1}[0-9]{9}|^[8]{2}[01]{1}[0-9]{9}|^[01]{2}[0-9]{9})$/'],
        'password' => 'required'
    ];

    public static $signup_rules = [
        'name'=>'required',
        'phone' => ['required', 'regex:/(^[+]{1}[8]{2}[01]{1}[0-9]{9}|^[8]{2}[01]{1}[0-9]{9}|^[01]{2}[0-9]{9})$/', 'unique:users,phone'],
        'password' => 'required'
    ];

    public static $update_rules = [
        'phone' => ['sometimes', 'regex:/(^[+]{1}[8]{2}[01]{1}[0-9]{9}|^[8]{2}[01]{1}[0-9]{9}|^[01]{2}[0-9]{9})$/', 'unique:users,phone'],
        'age' => 'sometimes|numeric|between:0,120',
        'sex' => 'sometimes|in:male,female,other',
        'email' => 'sometimes|email',
        'address' => 'sometimes',
        'blood_group' => ['sometimes', 'regex:/^(A|B|AB|O)[-+]$/']
    ];

    public static $admin_rules = [
        'name'=>'required',
        'phone' => ['required', 'regex:/(^[+]{1}[8]{2}[01]{1}[0-9]{9}|^[8]{2}[01]{1}[0-9]{9}|^[01]{2}[0-9]{9})$/', 'unique:users,phone'],
        'age' => 'sometimes|numeric|between:0,120',
        'sex' => 'sometimes|in:male,female,other',
        'email' => 'sometimes|email',
        'address' => 'sometimes',
        'usertypes' => 'required',
        'password' => 'required',
        'blood_group' => ['sometimes', 'regex:/^(A|B|AB|O)[-+]$/']
    ];

    public static $password_rules = [
        'password'=>'required',
        'newpassword'=>'required|same:newpassword',
        'confirmnewpassword'=>'required|same:newpassword'
    ];

    public function usertypes(){
        return $this->belongsToMany('App\UserType');
    }

    public function hastype($name){
    
        if($this->usertypes()->where('type',$name)->first()){
            return true;
        }
        return false;
    }

    public function isactive(){
        if($this->isactive=="1"){
            return true;
        }
        return false;
    }

    public function orders(){
        return $this->hasMany('App\Order', 'user_id', 'id' );
    }

    public function coupon(){
        return $this->belongsTo('App\Coupon');
    }

    public function discount(){
        if($this->coupon_id != 0){
            return Coupon::where('id', $this->coupon_id)->first()->discount;
        }
        return 0;
    }
    public function usertoken(){
        return $this->hasOne('App\UserToken', 'user_id', 'id');
    }

}
