<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public static $rules = [
    'category' => 'required|unique:categories',
    ];


    public function tests(){
        return $this->hasMany('App\Test','category_id','id');
    }
}