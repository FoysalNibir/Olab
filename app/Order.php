<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'patient', 'age', 'sex', 'status','address','collection_date','collection_time','report_date','report_time','self','phone','discount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public static $rules = [
    'patient' => 'required',
    'phone' => ['required', 'regex:/(^[+]{1}[8]{2}[01]{1}[0-9]{9}|^[8]{2}[01]{1}[0-9]{9}|^[01]{2}[0-9]{9})$/'],
    'address' => 'required',
    'age' => 'required|numeric|between:0,120',
    'sex' => 'required|in:male,female,other',
    'operation_user'=> 'sometimes|users,id',
    'field_collect_user'=> 'sometimes|users,id',
    'field_submit_user'=> 'sometimes|users,id',
    'report_user'=> 'sometimes|users,id',
    'collection_date'=> 'sometimes|date_format:MM:dd:YYYY',
    'collection_time' => 'sometimes|date_format:H:i',
    'report_date'=> 'sometimes|date_format:MM:dd:YYYY',
    'report_time' => 'sometimes|date_format:H:i'
    ];

    public static $lab_submit_rule = [
    'report_date'=> 'date_format:"Y-m-d"|required',
    'report_time' => 'date_format:H:i|required',
    'lab_reference' => 'required'
    ];

    public static $collection_info_rule = [
    'collection_date'=> 'date_format:"Y-m-d"|required',
    'collection_time' => 'date_format:H:i|required'
    ];


    public function ordertest(){
       return $this->hasMany('App\OrderTest', 'order_id', 'id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
    public function tests(){
        return $this->belongsToMany('App\Test');
    }

    public function total() {
        return $this->belongsToMany('App\Test')->sum('price');
    }
    
}