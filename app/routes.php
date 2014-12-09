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

/* 
 * Authentication
 */
Route::when('*', 'csrf', ['post', 'put', 'patch', 'delete']);
Route::get('login', array('as' => 'login', 'uses' => 'SessionsController@create'));
Route::post('login', array('as' => 'login.store', 'uses' => 'SessionsController@store'));


Route::group(['before' => 'auth'], function(){

    /*
     * Logout
     */
    Route::get('logout', array('as' => 'logout', 'uses' => 'SessionsController@destroy'));

    /*
     * PagesController
     */
    Route::get('/', array('as' => 'home', 'uses' => 'PagesController@showHome'));
    Route::get('profile', array('as' => 'profile.show', 'uses' => 'PagesController@showProfile'));
    Route::patch('profile/update/', array('as' => 'profile.update', 'uses' => 'PagesController@updateProfile'));

    /*
     * Studies, SubStudies, QuestionGroups and Questions
     */
    Route::get('study/my', ['as' => 'study.my', 'uses' => 'StudyController@myStudies']);
    Route::get('study/{studyId}/users', ['as' => 'study.users.view', 'uses' => 'StudyController@viewUsers']);
    Route::post('study/{studyId}/users', ['as' => 'study.users.set', 'uses' => 'StudyController@setUsers']);
    Route::resource('study', 'StudyController');
    Route::resource('study.substudy', 'SubStudyController');
    Route::resource('study.substudy.questiongroup', 'QuestionGroupController');
    Route::resource('study.substudy.question', 'QuestionController');

    /*
     * Study Access requests
     */
    Route::get('request/new/{studyId}', ['as' => 'request.new', 'uses' => 'StudyRequestController@newRequest']);
    Route::resource('request', 'StudyRequestController', ['except' => ['create']]);
});


//Studies Routes: expanded to ease use of filters

/*
 * Administration Panel - Access restricted to authenticated users with the role 'admin'
 */
Route::group(array('before' => array('auth', 'admin')), function(){
	
	/*
	 * Admin - User management
	 */
    Route::patch('admin/users/{users}/resend', ['as' => 'admin.users.resend', 'uses' => 'UsersController@resendPassword']);
	Route::resource('admin/users', 'UsersController');
});
