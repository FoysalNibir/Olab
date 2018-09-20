<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'test', 'price','category_id','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public static $rules = [
        'test' => 'required',
        'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        'category_id' => 'required|exists:categories,id',
        'active' => 'in:0,1'
    ];

    public static $update_rules = [
        'id' => 'required|exists:tests,id',
        'price' => 'required|regex:/^\d*(\.\d{1,2})?$/'
    ];
    

    public function category(){
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function orders(){
     return $this->belongsToMany('App\Order');
 }
}