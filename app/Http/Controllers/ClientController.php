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
use App\Test;
use App\OrderTest;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends BaseController
{
	use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	public function ordercreate(Request $request){

		$patients=Order::where('user_id', Auth::user()->id)->where('self','!=','1')->groupBy('patient')->get();
		$user=Auth::user();
		$tests=Test::where('active','1')->get();
		return View::make('client.ordercreate', compact('patients','user','tests'));

	}

	public function postordercreate(Request $request, Order $order){

		$validator = Validator::make($request->all(), Order::$rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$attachvalidator = Validator::make($request->all(), OrderTest::$test_attach_rules);
		if ($attachvalidator->fails()){
			return Redirect::back()->withErrors($attachvalidator)->withInput();
		}

		$tests=$request->get('tests');

		$order=new Order;
		$order->self=$request->get('patient_select') === "self" ? "1" : "0";	
		$order->patient=$request->get('patient');
		$order->age=$request->get('age');
		$order->sex=$request->get('sex');
		$order->user_id=Auth::user()->id;
		$order->status='operation';
		$order->phone=$request->get('phone');
		$order->address=$request->get('address');
		$order->discount= Auth::user()->discount();
		$order->total = $this->calculateWithDiscount($tests);
		$result=$order->save();		
		if($result){
			$order->tests()->attach($tests);
			return Redirect()->route('client.order.detail', $order['id'])->with('status','Order Created');
		}
		return Redirect()->back()->with('error','Cannot create order');
	}

	public function calculateWithDiscount($tests){
		$total = Test::whereIn('id', $tests)->sum('price');
		if (Auth::user()->coupon_id != 0) {
			$discount = Auth::user()->discount();
			if (Coupon::where('id', Auth::user()->coupon_id)->first()->end_date >= Carbon::now()) {
				return $total-$discount;
			}
		}
		
		return $total;
	}

	public function orders(){
		$orders=Auth::user()->orders()->orderBy('created_at')->paginate(10);
		return View::make('client.orders', compact('orders'));
	}

	public function orderdetail($id){
		$order=Order::where('id', $id)->with('tests')->first();
		$total=Order::where('id', $id)->first()->total;
		$coupon_id=Auth::user()->coupon_id;
		return View::make('client.details',compact('order','total'));
	}

	public function getaddpromo(){
		$promo = Auth::user()->coupon()->first();
		return View::make('client.addpromo',compact('promo'));
	}

	public function postaddpromo(Request $request){
		$promo = $request->get('addpromo');
		if ($promo && Coupon::where('coupon', $promo)->first()) {
			if (Carbon::now() <= Coupon::where('coupon', $promo)->first()->end_date) {
				$user = Auth::user();
				$user->coupon_id = Coupon::where('coupon', $promo)->first()->id;
				$result = $user->update();
				if($result){
					return Redirect()->back()->with('status','Promo added successfully');
				}
				return Redirect()->back()->with('status','Promo could not be added');
			}
			return Redirect()->back()->with('status','This Promo is Expired');
		}
		return Redirect()->back()->with('status','Enter a valid Promo code');						
	}

}