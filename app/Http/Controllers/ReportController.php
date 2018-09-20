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

class ReportController extends BaseController{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct(){
		$this->middleware('isreport');
	}

    public function today(Order $orders){
		$orders=Order::where('status','inlab')->where('report_date','=', Carbon::today()->toDateString())->paginate(10);
		return View::make('report.today',compact('orders'));
	}

	public function pending(Order $orders){
		$orders=Order::where('status','inlab')->orderBy('report_date')->orderBy('report_time')->paginate(10);
		return View::make('report.pending',compact('orders'));
	}

	public function deliverred(Order $orders){
		$orders=Order::where('status','deliverred')->orderBy('report_date')->orderBy('report_time')->paginate(10);
		return View::make('report.deliverred',compact('orders'));
	}

	public function details($id){
		$order=Order::where('id', $id)->with('tests')->first();
    	$total=Order::where('id', $id)->first()->total();
		return View::make('client.details',compact('order','total'));
	}

	public function confirmdelivery($id, Request $request){

		$order=Order::where('id',$id)->first();
		if($order->status=='inlab'){
			$order->status='deliverred';
			$order->report_user=Auth::user()->id;
			$order->update();
			return Redirect()->back()->with('status','Delivery confirmed');
		}
		return Redirect()->back()->with('error','Delivery cannot be confirmed');
	}

}