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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseController
{
	use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	public function getlogin(){
		return View::make('auth.login');
	}

	public function postlogin(Request $request,User $user){

		
		$validator = Validator::make($request->all(), User::$auth_rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$remember=$request->has('remember')?true:false;
		$user=User::where('phone',$request->get('phone'))->first();
		if($user){
			if($user['isactive']!=1){
				return Redirect::back()->with('status', 'Account is not activated yet');
			}
			if($user['ban']!=0){
				return Redirect::back()->with('status', 'Account is banned temporarily');
			}
		}
		
		if (Auth::attempt(array('phone' => $request->input('phone'), 'password' => $request->input('password'), 'isactive' => '1', 'ban' => '0'), $remember)){
			return Redirect::route('dashboard');		
		}

		return Redirect::route('login')->with('status','invalid credentials');

	}

	public function getlogout(){
		Auth::logout();
		return Redirect::route('login');
	}
}