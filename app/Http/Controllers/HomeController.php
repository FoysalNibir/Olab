<?php

namespace App\Http\Controllers;

use Redirect;
use View;
use Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{

	public function gethome(){
		return View::make('home');
	}

	public function postsignup(Request $request){
		$validator = Validator::make($request->all(), User::$signup_rules);
		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$user=new User();
		$user->name=$request->get('name');
		$user->phone=$request->get('phone');
		$user->password= bcrypt($request->get('password'));
		$result=$user->save();
		if($result){
			return Redirect::route('login')->with('status','successful. wait for activation');
		}
		return Redirect::back()->with('status','failed request');
	}

	public function getforgotpassword(){
		return View::make('auth.forgotpassword');
	}

	public function postforgotpassword(Request $request){
		$this->validate($request, ['phone' => 'required']);

		$user=User::where('phone',$request->get('phone'))->first();
		if($user['email']==""){
			return Redirect()->back()->with('status', 'You dont have email assigned. Contact admin for reset');
		}
		
		$response = Password::sendResetLink($request->only('phone'), function (Message $message) {
			$message->subject($this->getEmailSubject());
		});

		switch ($response) {
			case Password::RESET_LINK_SENT:
			return redirect()->back()->with('status', trans($response));

			case Password::INVALID_USER:
			return redirect()->back()->withErrors(['phone' => trans($response)]);
		}
	}

	protected function getEmailSubject(){
		return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
	}

	public function getreset($token = null){
		if (is_null($token)) {
			throw new NotFoundHttpException;
		}

		return view('auth.reset')->with('token', $token);
	}

	public function postreset(Request $request){
		$this->validate($request, [
			'token' => 'required',
			'phone' => 'required',
			'password' => 'required|confirmed',
		]);

		$credentials = $request->only(
			'phone', 'password', 'password_confirmation', 'token'
		);


		$response = Password::reset($credentials, function ($user, $password) {
			$this->resetPassword($user, $password);
		});

		switch ($response) {
			case Password::PASSWORD_RESET:
			return redirect($this->redirectPath());

			default:
			return redirect()->back()
			->withInput($request->only('phone'))
			->withErrors(['phone' => trans($response)]);
		}
	}

	protected function resetPassword($user, $password){
		$user->password = bcrypt($password);
		$user->save();
		Auth::login($user);
	}

   /**
    * Get the post register / login redirect path.
    *
    * @return string
    */
    public function redirectPath(){
   	if (property_exists($this, 'redirectPath')) {
   		return $this->redirectPath;
   	}

   		return property_exists($this, 'redirectTo') ? $this->redirectTo : 'dashboard';
    }

    public function changepassword(){
   		return View::make('changepassword');
    }

    public function postchangepassword(Request $request){
   		$validator = Validator::make($request->all(), User::$password_rules);
   		if ($validator->fails()){
   			return Redirect::back()->withErrors($validator)->withInput();
   		}
   		$user=Auth::user();
   		if(Hash::check($request->get('password'), $user->password)){	
   			$user->password=bcrypt($request->get('newpassword'));
   			$result=$user->update();
   			if($result){
   				return Redirect::back()->with('status', 'Password updated');
   			}
   			return Redirect::back()->with('status', 'Password could not be updated');
   		}
   		return Redirect::back()->with('status', 'Current password is wrong');

   }



}
