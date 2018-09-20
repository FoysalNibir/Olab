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
use \Carbon\Carbon;
use App\User;
use App\Test;
use App\Category;
use App\Order;
use App\UserUserType;
use App\UserType;
use App\Coupon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends BaseController
{
	use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


	public function __construct(){
		$this->middleware('isadmin');
	}

	public function getusers(Request $request, User $users){

		$inputs=$request->all();


		$users=$users->newQuery();
		if($request->has('user_type')){	
			$users->whereHas('usertypes', function($q) use($inputs) {
				$q->where('user_type_id', $inputs['user_type']);
			})->get();
		}    	   	
		if($request->has('name')){
			$users->where('name','like', '%'.$inputs['name'].'%')->get();			
		}
		if($request->has('phone')){
			$users->where('phone','like', '%'.$inputs['phone'].'%')->get();			
		}
		if($request->has('email')){
			$users->where('email','like', '%'.$inputs['email'].'%')->get();			
		}
		if($request->has('sex')){
			$users->where('sex', $inputs['sex'])->get();			
		}
		if($request->has('age')){
			$users->where('age', $inputs['age'])->get();			
		}
		if($request->has('blood_group')){
			$users->where('blood_group', $inputs['blood_group'])->get();			
		}

		if($request->has('address')){
			$users->where('address','like', '%'.$inputs['address'].'%')->get();			
		}

		$users=$users->where('isactive','1')->with('usertypes')->paginate(10);
		$usertypes=UserType::all();
		return View::make('admin.users',compact('users','usertypes','inputs'));
	}

	public function getorders(Request $request, Order $orders){
		$inputs=$request->all();
		$orders=$orders->newQuery();
		if($request->has('lab_reference')){
			$orders->where('lab_reference','like', '%'.$inputs['lab_reference'].'%')->get();			
		}
		if($request->has('patient')){
			$orders->where('patient','like', '%'.$inputs['patient'].'%')->get();			
		}
		if($request->has('report_date')){
			$orders->where('report_date','like', '%'.$inputs['report_date'].'%')->get();			
		}
		if($request->has('report_time')){
			$orders->where('report_time','like', '%'.$inputs['report_time'].'%')->get();			
		}
		if($request->has('collection_date')){
			$orders->where('collection_date','like', '%'.$inputs['collection_date'].'%')->get();			
		}
		if($request->has('collection_time')){
			$orders->where('collection_time','like', '%'.$inputs['collection_time'].'%')->get();			
		}
		if($request->has('address')){
			$orders->where('address','like', '%'.$inputs['address'].'%')->get();			
		}
		if($request->has('status')){
			$orders->where('status','like', '%'.$inputs['status'].'%')->get();			
		}

		$orders=$orders->orderBy('id','DESC')->paginate(10);
		return View::make('admin.orders',compact('orders'));
	}

	public function createuser(){
		$usertypes=UserType::all();
		return View::make('admin.createuser',compact('usertypes'));
	}

	public function getdashboard(){
		$clients=UserType::where('id', '1')->withCount('users')->first();
		$orders=Order::count();
		$tests=Test::count();
		$delivered=Order::where('status','deliverred')->count();
		$pending=Order::where('status','operation')->count();
		$field=Order::where('status','field')->count();
		$inlab=Order::where('status','inlab')->count();
		$call_missed=Order::where('status','call_missed')->count();
		$order_today=Order::where('created_at', '>=', Carbon::today())->count();
		return View::make('admin.dashboard',compact('clients','orders','tests','delivered','pending','field','inlab','call_missed','order_today'));
	}

	public function postcreateuser(Request $request){
		$validator = Validator::make($request->all(), User::$admin_rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$attachvalidator = Validator::make($request->all(), UserUserType::$usertype_attach_rules);
		if ($attachvalidator->fails()){
			return Redirect::back()->withErrors($attachvalidator)->withInput();
		}

		$usertypes=$request->get('usertypes');
		$newuser=new User;
		$newuser['isactive']='1';
		$newuser['name']=$request->get('name');
		$newuser['sex']=$request->get('sex');
		$newuser['age']=$request->get('age');
		$newuser['phone']=$request->get('phone');
		$newuser['email']=$request->get('email');
		$newuser['address']=$request->get('address');
		$newuser['blood_group']=$request->get('blood_group');
		$newuser['password']=bcrypt($request->get('password'));
		$result=$newuser->save();
		if($result){
			$newuser->usertypes()->attach($usertypes);
			return Redirect()->back()->with('status','Account created.');
		}
		
		return Redirect()->back()->with('status','Account could not be created.');
		
	}

	public function getsignuprequests(){
		$users=User::where('isactive','0')->paginate(10);
		return View::make('admin.signuprequest',compact('users'));
	}

	public function getuseractivate($id){
		$user=User::where('id', $id)->first();
		$user->isactive=1;
		$user->update();
		$user->usertypes()->attach(1);
		return Redirect()->back()->with('status','Account activated successfully');
	}

	public function getuserdelete($id){
		$user=User::where('id', $id)->delete();
		return Redirect()->back()->with('status','Account deleted successfully');
	}

	public function getuserban($id){
		$user=User::where('id', $id)->first();
		$user->ban=1;
		$user->update();
		return Redirect()->back()->with('status','Account banned successfully');
	}

	public function getuserunban($id){
		$user=User::where('id', $id)->first();
		$user->ban=0;
		$user->update();
		return Redirect()->back()->with('status','Account unbanned successfully');
	}

	public function getuserusertype($id){
		$userusertypes=User::where('id',$id)->with('usertypes')->first();
		$usertypes=UserType::all();
		return View::make('admin.userusertype',compact('userusertypes','usertypes'));
	}

	public function postuserusertype($id, Request $request){

		$attachvalidator = Validator::make($request->all(), UserUserType::$usertype_attach_rules);
		if ($attachvalidator->fails()){
			return Redirect::back()->withErrors($attachvalidator)->withInput();
		}
		$user=User::where('id',$id)->first();
		if ($user) {
			$user->usertypes()->sync($request->get('usertypes'),false);
			return Redirect()->back()->with('status','successful');
		}
		return Redirect()->back()->with('status','failed');
	}

	public function deleteuserusertype($user, $usertype){
		$user=User::where('id',$user)->first();
		$user->usertypes()->detach($usertype);
		return Redirect()->back()->with('status','deletion successfull');
	}

	public function gettest(){
		$categories=Category::all();
		$tests=Test::with('category')->paginate(10);
		return View::make('admin.tests',compact('tests','categories'));
	}

	public function posttest(Request $request){
		$validator = Validator::make($request->all(), Test::$rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$test=new Test();
		$test->test=$request->get('test');
		$test->price=$request->get('price');
		$test->category_id=$request->get('category_id');
		$result=$test->save();
		if($result){
			return Redirect::back()->with('status', 'Test created');
		}
		return Redirect::back()->with('status', 'Test could not be created');
	}
	
	public function updatetest(Request $request){
		$validator = Validator::make($request->all(), Test::$update_rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$test=Test::where('id', $request->get('id'))->first();
		$test->price=$request->get('price');
		$result=$test->update();
		if($result){
			return Redirect::back()->with('status', 'Test updated');
		}
		return Redirect::back()->with('status', 'Test could not be updated');
	}

	public function gettestenable($id){
		$test=Test::where('id', $id)->first();
		$test->active=1;
		$test->update();
		return Redirect()->back()->with('status','Test activated successfully');
	}

	public function gettestdisable($id){
		$test=Test::where('id', $id)->first();
		$test->active=0;
		$test->update();
		return Redirect()->back()->with('status','Test deactivated successfully');
	}

	public function gettestdelete($id){
		$test=Test::where('id', $id)->delete();
		return Redirect()->back()->with('status','Test deleted successfully');
	}


	public function getcategory(){
		$categories=Category::paginate(10);
		return View::make('admin.categories',compact('categories'));
	}

	public function postcategory(Request $request){
		$validator = Validator::make($request->all(), Category::$rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$category=new Category();
		$category['category']=$request->get('category');
		$result=$category->save();
		if($result){
			return Redirect()->back()->with('status','Category added successfully');
		}
		return Redirect()->back()->with('status','Category could not be added');
	}

	public function getcoupon(){
		$coupons=Coupon::paginate(10);
		return View::make('admin.coupons',compact('coupons'));
	}

	public function postcoupon(Request $request){
		$validator = Validator::make($request->all(), Coupon::$rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$coupon=new Coupon();
		$coupon->coupon = $request->get('coupon');
		$coupon->discount = $request->get('discount');
		$coupon->end_date = $request->get('end_date');
		$result=$coupon->save();
		if($result){
			return Redirect()->back()->with('status','Coupon added successfully');
		}
		return Redirect()->back()->with('status','Coupon could not be added');
	}

	public function updatecoupon(Request $request){
		$validator = Validator::make($request->all(), Coupon::$update_rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$coupon=Coupon::where('id', $request->get('id'))->first();
		$coupon->end_date=$request->get('end_date');
		$result=$coupon->update();
		if($result){
			return Redirect::back()->with('status', 'Coupon updated');
		}
		return Redirect::back()->with('status', 'Coupon could not be updated');
	}

	public function getcoupondelete($id){
		$coupon=Coupon::where('id', $id)->delete();
		return Redirect()->back()->with('status','Coupon deleted successfully');
	}


}