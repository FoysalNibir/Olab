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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function getdashboard(){
    	$user=Auth::user();
		return View::make('dashboard.dashboard',compact('user'));
	}

	public function postupdateprofile(Request $request){
		$validator = Validator::make($request->except('phone'), User::$update_rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$input = $request->except('phone');
    	$user=Auth::user();
    	$user->fill($input);
    	$user->update();
		return Redirect()->back()->with('status','Information Updated');
	}

}