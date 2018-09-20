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

class FieldController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct(){
		$this->middleware('isfield');
	}

    public function today(Order $orders){
		$orders=Order::where('status','field')->where('collection_date', Carbon::today()->toDateString())->orderBy('collection_time')->paginate(10);
		return View::make('field.today',compact('orders'));
	}

    public function pending(Order $orders){
		$orders=Order::where('status','field')->orderBy('collection_date')->orderBy('collection_time')->paginate(10);
		return View::make('field.pending',compact('orders'));
	}

	public function collected(Order $orders){
		$orders=Order::where('status','collected')->orderBy('updated_at')->paginate(10);
		return View::make('field.collected',compact('orders'));
	}

	
	public function inlab(Order $orders){
		$orders=Order::where('status','inlab')->orderBy('updated_at')->paginate(10);
		return View::make('field.inlab',compact('orders'));
	}

	public function details($id){
		$order=Order::where('id', $id)->with('tests')->first();
    	$total=Order::where('id', $id)->first()->total();
		return View::make('client.details',compact('order','total'));
	}

	public function confirmcollection($id){
		$order=Order::where('id',$id)->first();
		if($order->status=='field'){
			$order->status='collected';
			$order->field_collect_user=Auth::user()->id;
			$order->update();
			return Redirect()->back()->with('status','order collection confirmed');
		}
		return Redirect()->back()->with('error','order collection cannot be confirmed');
		
	}
	public function confirmlabsubmit($id, Request $request){


		//return $request->get('report_date');

		$validator = Validator::make($request->all(), Order::$lab_submit_rule);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$order=Order::where('id',$id)->first();
		if($order->status=='collected'){
			$order->status='inlab';
			$order->field_submit_user=Auth::user()->id;
			$order->report_date=$request->get('report_date');
			$order->report_time=$request->get('report_time');
			$order->lab_reference=$request->get('lab_reference');
			$order->update();
			return Redirect()->back()->with('status','lab submission confirmed');
		}
		return Redirect()->back()->with('error','lab submission cannot be confirmed');
	}
}