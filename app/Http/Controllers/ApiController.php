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
use App\UserToken;
use Carbon\Carbon;
use App\Order;
use App\OrderTest;
use App\Coupon;
use App\Test;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends BaseController
{
	use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	public function postsignup(Request $request){

		$validator = Validator::make($request->all(), User::$signup_rules);

		if ($validator->fails()){
			$result['status']='fail';
			$result['message']='Validation unseccessful';
			return $result;
		}

		$user=new User();
		$user->name=$request->get('name');
		$user->phone=$request->get('phone');
		$user->password= bcrypt($request->get('password'));
		$save=$user->save();

		if($save){
			$result['status']='success';
			$result['message']='SignUp successful. Please wait for activation';
			return $result;
		}

		$result['status']='fail';
		$result['message']='SignUp unsuccessful';
		return $result;
	}

	public function postlogin(Request $request,User $user){

		$validator = Validator::make($request->all(), User::$auth_rules);

		if ($validator->fails()){
			$result['status']='fail';
			$result['message']='Validation unseccessful';
			return $result;
		}

		$remember=$request->has('remember')?true:false;
		$user=User::where('phone',$request->get('phone'))->first();

		if($user){
			if($user['isactive']!=1){
				$result['status']='fail';
				$result['message']='Account is not activated yet';
				return $result;
			}
			if($user['ban']!=0){
				$result['status']='fail';
				$result['message']='Account is banned temporarily';
				return $result;
			}
		}
		
		if (Auth::attempt(array('phone' => $request->input('phone'), 'password' => $request->input('password'), 'isactive' => '1', 'ban' => '0'), $remember)){
			$usertoken=new UserToken;
			$usertoken->user_id=$user->id;
			$usertoken->usertoken=$user->remember_token;
			$save=$usertoken->save();

			if ($save){
				$usertoken=UserToken::where('user_id', $user->id)->first();
				$token=$usertoken->usertoken;
				if (!$token) {
					$token=str_random(60);
					$usertoken->usertoken=$token;
					$update=$usertoken->update();
				}				
				$result['status']='success';
				$result['message']='Login successful';
				$result['data']=$token;
				return $result;
			}					
		}

		$result['status']='fail';
		$result['message']='Invalid credentials';
		return $result;

	}

	public function postchangepassword(Request $request){

		$usertoken = $this->checktoken($request);

		if ($usertoken) {
			$validator = Validator::make($request->all(), User::$password_rules);
			if ($validator->fails()){
				$result['status']='fail';
				$result['message']='Validation unseccessful';
				return $result;
			}

			$user=$usertoken->user()->first();

			if(Hash::check($request->get('password'), $user->password)){	

				$user->password=bcrypt($request->get('newpassword'));
				$update=$user->update();

				if($update){
					$result['status']='successful';
					$result['message']='Password updated';
					return $result;	
				}

				$result['status']='fail';
				$result['message']='Password could not be updated';
				return $result;
			}

			$result['status']='fail';
			$result['message']='Current password is wrong';
			return $result;
		}

		$result['status']='fail';
		$result['message']='Invalid token';
		return $result;
	}

	public function postforgotpassword(Request $request){

		$this->validate($request, ['phone' => 'required']);
		$user=User::where('phone',$request->get('phone'))->first();

		if($user['email']==""){
			$result['status']='fail';
			$result['message']='You dont have email assigned. Contact admin for reset';
			return $result;
		}
		
		$response = Password::sendResetLink($request->only('phone'), function (Message $message) {
			$message->subject($this->getEmailSubject());
		});

		switch ($response) {
			case Password::RESET_LINK_SENT:
			$result['status']='successful';
			$result['message']='Reset link sent to email';
			return $result;

			case Password::INVALID_USER:
			$result['status']='fail';
			$result['message']='Invalid user';
			return $result;
		}
	}

	protected function getEmailSubject(){

		return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
	}

	public function getorders(Request $request){

		$usertoken = $this->checktoken($request);	

		if ($usertoken) {
			$orders = $usertoken->user()->first()->orders()->orderBy('created_at')->paginate(5);
			$result['status']='success';
			$result['message']='Orders fetched successfully';				
			$result['data']=$orders;
			return $result;
		}

		$result['status']='fail';
		$result['message']='Invalid token';
		return $result;
	}

	public function getorderdetails(Request $request, $id){

		$usertoken = $this->checktoken($request);

		if ($usertoken) {
			$details=Order::where('id', $id)->with('tests')->first();
			$result['status']='success';
			$result['message']='Details fetched successfully';
			$result['data']=$details;				
			return $result;
		}

		$result['status']='fail';
		$result['message']='Invalid token';
		return $result;			 
	}

	public function ordercreate(Request $request){

		$usertoken = $this->checktoken($request);

		if ($usertoken) {
			$patients=Order::where('user_id', $usertoken->user()->first()->id)->where('self','!=','1')->groupBy('patient')->get();
			$user=$usertoken->user()->first();
			$tests=Test::where('active','1')->get();
			$result['status']='successful';
			$result['message']='Order create details';
			$result['patients']=$patients;
			$result['tests']=$tests;
			$result['data']=array('patients' => $patients,'user' => $user,'tests' => $tests);
			return $result;
			
		}

		$result['status']='fail';
		$result['message']='Invalid token';
		return $result;
	}

	public function postordercreate(Request $request, Order $order){

		$usertoken = $this->checktoken($request);

		if ($usertoken){
			$validator = Validator::make($request->all(), Order::$rules);
			if ($validator->fails()){
				$result['status']='fail';
				$result['message']='Validation unseccessful';
				return $result;
			}

			$attachvalidator = Validator::make($request->all(), OrderTest::$test_attach_rules);

			if ($attachvalidator->fails()){
				$result['status']='fail';
				$result['message']='Validation attachment unseccessful';
				return $result;
			}

			$tests=$request->get('tests');

			$order=new Order;
			$order->self=$request->get('patient_select') === "self" ? "1" : "0";	
			$order->patient=$request->get('patient');
			$order->age=$request->get('age');
			$order->sex=$request->get('sex');
			$order->user_id= $usertoken->user()->first()->id;
			$order->status='operation';
			$order->phone=$request->get('phone');
			$order->address=$request->get('address');
			$order->discount= $usertoken->user()->first()->discount();
			$order->total = $this->calculateWithDiscount($tests,$usertoken);
			$save=$order->save();

			if($save){
				$order->tests()->attach($tests);
				$result['status']='success';
				$result['message']='Order created successfully';
				return $result;
			}

			$result['status']='fail';
			$result['message']='Order could not be created';				
			return $result;
		}

		$result['status']='fail';
		$result['message']='Invalid token';
		return $result;			 
	}

	public function calculateWithDiscount($tests,$usertoken){

		$total = Test::whereIn('id', $tests)->sum('price');

		if ($usertoken->user()->first()->coupon_id != 0) {
			$discount = $usertoken->user()->first()->discount();

			if (Coupon::where('id',  $usertoken->user()->first()->coupon_id)->first()->end_date >= Carbon::now()) {
				return $total-$discount;
			}

		}
		
		return $total;
	}
	public function getaddpromo(Request $request){

		$usertoken = $this->checktoken($request);

		if ($usertoken){	
			$promo_details = $usertoken->user()->first()->coupon()->first();
			$result['status']='successful';
			$result['message']='Coupon details';
			$result['data']=$promo_details;
			return $result;
		}

		$result['status']='fail';
		$result['message']='Invalid token';
		return $result;		
	}

	public function postaddpromo(Request $request){

		$usertoken = $this->checktoken($request);

		if ($usertoken){		
			$promo = $request->get('addpromo');
			$check_promo=Coupon::where('coupon', $promo)->first();

			if ($promo && $check_promo){				

				if (Carbon::now() <= Coupon::where('coupon', $promo)->first()->end_date) {
					$user=$usertoken->user()->first();
					$user->coupon_id = Coupon::where('coupon', $promo)->first()->id;
					$update = $user->update();

					if($update){
						$result['status']='successful';
						$result['message']='Promo added successfully';						
						return $result;
					}

					$result['status']='fail';
					$result['message']='Promo could not be added';
					return $result;
				}

				$result['status']='fail';
				$result['message']='This Promo is Expired';
				return $result;
			}

			$result['status']='fail';
			$result['message']='Enter a valid Promo code';
			return $result;
		}

		$result['status']='fail';
		$result['message']='Invalid token';
		return $result;
	}

	public function getdashboard(Request $request){

		$usertoken = $this->checktoken($request);

		if ($usertoken) {
			$user=$usertoken->user()->first();
			$result['status']='success';
			$result['message']='user information for dashboard';
			$result['data']=$user;
			return $result;
		}

		$result['status']='fail';
		$result['message']='Invalid token';
		return $result;    	
	}

	public function postupdateprofile(Request $request){
		$validator = Validator::make($request->except('phone'), User::$update_rules);

		if ($validator->fails()){
			$result['status']='fail';
			$result['message']='Validation unseccessful';
			return $result;
		}

		$usertoken = $this->checktoken($request);

		if ($usertoken) {
			$input = $request->except('phone');
    		$user=$usertoken->user()->first();
    		$user->fill($input);
    		$user->update();
			$result['status']='success';
			$result['message']='Information updated';
			return $result;
		}

		$result['status']='fail';
		$result['message']='Invalid token';
		return $result;
	}

	public function checktoken(Request $request){

		if ($request->headers->has('usertoken')) {
			$token = $request->header('usertoken');
			$usertoken = UserToken::where('usertoken',$token)->first();

			if ($usertoken) {
				return $usertoken;
			}

			return false;		 
		}

		return false;
	}
}