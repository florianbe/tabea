<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'before' => 'auth', 'uses' => 'PagesController@index'));


/* 
 * Authentication
 */
Route::get('login', array('as' => 'login', 'uses' => 'SessionsController@create'));
Route::post('login', array('as' => 'login.store', 'uses' => 'SessionsController@store'));
Route::get('logout', array('as' => 'logout', 'uses' => 'SessionsController@destroy'));


/*
 * Administration Panel - Access restricted to authenticated users with the role 'admin'
 */
Route::group(array('before' => array('auth', 'admin')), function(){
	
	/*
	 * Admin - User management
	 */
	Route::resource('admin/users', 'UsersController');
	Route::get('admin/users', array('as' => 'users', 'uses' => 'UsersController@index'));
});
