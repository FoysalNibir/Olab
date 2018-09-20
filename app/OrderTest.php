<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderTest extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id','test_id','lab_entry','lab_report'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public static $test_attach_rules = [
    'tests' => 'required|array|min:1|exists:tests,id'
    ];

    public function test(){
        return $this->hasOne('App\Test','id','test_id');
    }

    public function order(){
        return $this->hasOne('App\Order','id','order_id');
    }

}