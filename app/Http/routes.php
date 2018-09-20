<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', array('as' => 'home', 'uses' => 'HomeController@gethome'));
Route::post('signup', array('as' => 'signup.post', 'uses' => 'HomeController@postsignup'));

Route::get('login', array('as' => 'login', 'uses' => 'LoginController@getlogin'));
Route::post('login', array('as' => 'login.post', 'uses' => 'LoginController@postlogin'));
Route::get('logout', array('as' => 'logout', 'uses' => 'LoginController@getlogout'));

Route::get('forgotpassword', array('as' => 'forgotpassword', 'uses' => 'HomeController@getforgotpassword'));
Route::post('forgotpassword', array('as' => 'forgotpassword.post', 'uses' => 'HomeController@postforgotpassword'));

Route::get('password/reset/{token}', array('as' => 'password.reset', 'uses' => 'HomeController@getreset'));
Route::post('password/reset', array('as' => 'password.reset.post', 'uses' => 'HomeController@postreset'));



Route::group(['middleware' => ['auth','prevent-back-history']], function(){

	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'DashboardController@getdashboard'));
	Route::post('updateprofile', array('as' => 'updateprofile', 'uses' => 'DashboardController@postupdateprofile'));

	Route::get('admin/test', array('as' => 'admin.test', 'uses' => 'AdminController@gettest'));
	Route::post('admin/test', array('as' => 'admin.test.post', 'uses' => 'AdminController@posttest'));
	Route::post('admin/test/update', array('as' => 'admin.test.update', 'uses' => 'AdminController@updatetest'));
	Route::get('admin/test/enable/{id}', array('as' => 'admin.test.enable', 'uses' => 'AdminController@gettestenable'));
	Route::get('admin/test/delete/{id}', array('as' => 'admin.test.delete', 'uses' => 'AdminController@gettestdelete'));
	Route::get('admin/test/disable/{id}', array('as' => 'admin.test.disable', 'uses' => 'AdminController@gettestdisable'));

	Route::get('admin/category', array('as' => 'admin.category', 'uses' => 'AdminController@getcategory'));
	Route::post('admin/category', array('as' => 'admin.category.post', 'uses' => 'AdminController@postcategory'));


	Route::get('admin/coupon', array('as' => 'admin.coupon', 'uses' => 'AdminController@getcoupon'));
	Route::post('admin/coupon', array('as' => 'admin.coupon.post', 'uses' => 'AdminController@postcoupon'));
	Route::post('admin/coupon/update', array('as' => 'admin.coupon.update', 'uses' => 'AdminController@updatecoupon'));
	Route::get('admin/coupon/delete/{id}', array('as' => 'admin.coupon.delete', 'uses' => 'AdminController@getcoupondelete'));

	Route::get('admin/dashboard', array('as' => 'admin.dashboard', 'uses' => 'AdminController@getdashboard'));
	Route::get('admin/users', array('as' => 'admin.users', 'uses' => 'AdminController@getusers'));
	Route::get('admin/useractivate/{id}', array('as' => 'admin.useractivate', 'uses' => 'AdminController@getuseractivate'));
	Route::get('admin/userdelete/{id}', array('as' => 'admin.userdelete', 'uses' => 'AdminController@getuserdelete'));
	Route::get('admin/userban/{id}', array('as' => 'admin.userban', 'uses' => 'AdminController@getuserban'));
	Route::get('admin/userunban/{id}', array('as' => 'admin.userunban', 'uses' => 'AdminController@getuserunban'));
	Route::get('admin/signuprequests', array('as' => 'admin.signuprequests', 'uses' => 'AdminController@getsignuprequests'));
	Route::get('admin/orders', array('as' => 'admin.orders', 'uses' => 'AdminController@getorders'));
	Route::get('admin/createuser', array('as' => 'admin.createuser', 'uses' => 'AdminController@createuser'));
	Route::post('admin/createuser', array('as' => 'admin.createuser.post', 'uses' => 'AdminController@postcreateuser'));
	Route::get('admin/user/usertype/{id}', array('as' => 'admin.user.usertype', 'uses' => 'AdminController@getuserusertype'));
	Route::post('admin/user/usertype/{id}', array('as' => 'admin.user.usertype.post', 'uses' => 'AdminController@postuserusertype'));
	Route::get('admin/user/{user}/usertype/{usertype}', array('as' => 'admin.user.usertype.delete', 'uses' => 'AdminController@deleteuserusertype'));


	Route::get('client/orders', array('as' => 'client.orders', 'uses' => 'ClientController@orders'));
	Route::get('client/order/detail/{id}', array('as' => 'client.order.detail', 'uses' => 'ClientController@orderdetail'));
	Route::get('client/order/create', array('as' => 'client.order.create', 'uses' => 'ClientController@ordercreate'));
	Route::post('client/order/create', array('as' => 'client.order.create.post', 'uses' => 'ClientController@postordercreate'));
	Route::get('client/addpromo', array('as' => 'client.addpromo', 'uses' => 'ClientController@getaddpromo'));
	Route::post('client/addpromo', array('as' => 'client.addpromo.post', 'uses' => 'ClientController@postaddpromo'));



	Route::get('field/today', array('as' => 'field.today', 'uses' => 'FieldController@today'));
	Route::get('field/pending', array('as' => 'field.pending', 'uses' => 'FieldController@pending'));
	Route::get('field/collected', array('as' => 'field.collected', 'uses' => 'FieldController@collected'));
	Route::get('field/inlab', array('as' => 'field.inlab', 'uses' => 'FieldController@inlab'));
	Route::get('field/details/{id}', array('as' => 'field.details', 'uses' => 'FieldController@details'));
	Route::get('field/confirmcollection/{id}', array('as' => 'field.confirmcollection', 'uses' => 'FieldController@confirmcollection'));
	Route::post('field/confirmlabsubmit/{id}', array('as' => 'field.confirmlabsubmit.post', 'uses' => 'FieldController@confirmlabsubmit'));


	Route::get('operation/today', array('as' => 'operation.today', 'uses' => 'OperationController@today'));
	Route::get('operation/pending', array('as' => 'operation.pending', 'uses' => 'OperationController@pending'));
	Route::get('operation/field', array('as' => 'operation.field', 'uses' => 'OperationController@field'));
	Route::get('operation/details/{id}', array('as' => 'operation.details', 'uses' => 'OperationController@details'));
	Route::post('operation/confirmcollectioninfo/{id}', array('as' => 'operation.confirmcollectioninfo.post', 'uses' => 'OperationController@confirmcollectioninfo'));
	Route::get('operation/setcallmissed/{id}', array('as' => 'operation.setcallmissed', 'uses' => 'OperationController@setcallmissed'));

	Route::get('report/today', array('as' => 'report.today', 'uses' => 'ReportController@today'));
	Route::get('report/pending', array('as' => 'report.pending', 'uses' => 'ReportController@pending'));
	Route::get('report/deliverred', array('as' => 'report.deliverred', 'uses' => 'ReportController@deliverred'));
	Route::get('report/details/{id}', array('as' => 'report.details', 'uses' => 'ReportController@details'));
	Route::get('report/confirmdelivery/{id}', array('as' => 'report.confirmdelivery', 'uses' => 'ReportController@confirmdelivery'));


	Route::get('changepassword', array('as' => 'changepassword', 'uses' => 'HomeController@changepassword'));
	Route::post('changepassword', array('as' => 'changepassword.post', 'uses' => 'HomeController@postchangepassword'));

});

Route::group(['prefix' => 'api'], function(){
	Route::get('orders', array('as' => 'api.orders', 'uses' => 'ApiController@getorders'));
	Route::get('orders/details/{id}', array('as' => 'api.orders.details', 'uses' => 'ApiController@getorderdetails'));
	Route::get('orders/create', array('as' => 'api.orders.create', 'uses' => 'ApiController@ordercreate'));
	Route::post('orders/create', array('as' => 'api.orders.create.post', 'uses' => 'ApiController@postordercreate'));
	Route::post('users/signup', array('as' => 'api.signup.post', 'uses' => 'ApiController@postsignup'));
	Route::post('users/login', array('as' => 'api.login.post', 'uses' => 'ApiController@postlogin'));
	Route::get('users/addpromo', array('as' => 'api.addpromo', 'uses' => 'ApiController@getaddpromo'));
	Route::post('users/addpromo', array('as' => 'api.addpromo.post', 'uses' => 'ApiController@postaddpromo'));
	Route::post('users/changepassword', array('as' => 'api.changepassword.post', 'uses' => 'ApiController@postchangepassword'));
	Route::post('forgotpassword', array('as' => 'api.forgotpassword.post', 'uses' => 'ApiController@postforgotpassword'));
	Route::get('dashboard', array('as' => 'api.dashboard', 'uses' => 'ApiController@getdashboard'));
	Route::post('updateprofile', array('as' => 'api.updateprofile.post', 'uses' => 'ApiController@postupdateprofile'));
});



