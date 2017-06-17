<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
	['middleware' => 'web'], function() {

		//Login Route

		Route::get('user/login', ['as' => 'user.login', 'uses' => 'UserController@login']);

		Route::post('user/loginUser', ['as' => 'user.loginuser', 'uses' => 'UserController@loginUser']);

		//Logout Route

		Route::get('logout', ['as' => 'user.logout', 'uses' => 'UserController@logout']);

		Route::group(
			['middleware' => 'auth'], function() {

				//Dashboard Route

				Route::resource('dashboard', 'DashboardController');

				//Create User Route

				Route::post('user/createUser', ['as' => 'user.create', 'uses' => 'UserController@createUser']);

				//User Edit Profile Route

				Route::get('user/editProfile', ['as' => 'user.editprofile', 'uses' => 'UserController@editProfile']);

				//User Update Profile Route

				Route::patch('user/updateProfile', ['as' => 'user.updateprofile', 'uses' => 'UserController@updateProfile']);

				//User Delete Account Route

				Route::get('user/deleteAccount', ['as' => 'user.deleteaccount', 'uses' => 'UserController@deleteAccount']);

				//User Change Password Route

				Route::get('user/changePassword', ['as' => 'user.changepassword', 'uses' => 'UserController@changePassword']);

			}
		);
	}
);
