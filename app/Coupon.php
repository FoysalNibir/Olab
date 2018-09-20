<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'coupons';

    protected $fillable = [
        'coupon', 'discount', 'end_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public static $rules = [
    'coupon' => 'required|unique:coupons',
    'discount' => 'required',
    'end_date' => 'required|date'
    ];

    public static $update_rules = [
    'id' => 'required|exists:coupons',
    'end_date' => 'required|date'
    ];


    public function users(){
        return $this->hasMany('App\User','coupon_id');
    }
}