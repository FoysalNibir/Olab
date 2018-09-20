<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;


use Illuminate\Http\Request;
use Redirect;
use View;
use Hash;
use App\User;
use App\Order;
use App\OrderTest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OperationController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct(){
		$this->middleware('isoperation');
	}


    public function today(Order $orders){
		$orders=Order::whereIn('status',array('operation','call_missed'))->where('created_at','>=', Carbon::today()->toDateString())->orderBy('created_at')->paginate(10);
		return View::make('operation.today',compact('orders'));
	}

    public function pending(Order $orders){
		$orders=Order::whereIn('status',array('operation','call_missed'))->orderBy('created_at')->paginate(10);
		return View::make('operation.pending',compact('orders'));
	}

	
	public function field(Order $orders){
		$orders=Order::where('status','field')->orderBy('updated_at')->paginate(10);
		return View::make('operation.field',compact('orders'));
	}

	public function details($id){
		$order=Order::where('id', $id)->with('tests')->first();
    	$total=Order::where('id', $id)->first()->total();
		return View::make('client.details',compact('order','total'));
	}

	
	public function confirmcollectioninfo($id, Request $request){

		$validator = Validator::make($request->all(), Order::$collection_info_rule);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$order=Order::where('id',$id)->first();
		if($order->status=='operation' || $order->status=='call_missed'){
			$order->status='field';
			$order->operation_user=Auth::user()->id;
			$order->collection_date=$request->get('collection_date');
			$order->collection_time=$request->get('collection_time');
			$order->update();
			return Redirect()->back()->with('status','Sent to field');
		}
		return Redirect()->back()->with('error','Cannot send to field');
	}

	public function setcallmissed($id){

		$order=Order::where('id',$id)->first();
		if($order->status=='operation'){
			$order->status='call_missed';
			$order->operation_user=Auth::user()->id;
			$order->update();
			return Redirect()->back()->with('status','Marked As Call Missed');
		}
		return Redirect()->back()->with('error','Marked As Call Missed');
	}
}