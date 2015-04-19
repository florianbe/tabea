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
    Route::get('studies/my', ['as' => 'studies.my', 'uses' => 'StudyController@myStudies']);
    Route::get('studies/{studies}/users', ['as' => 'studies.users.view', 'uses' => 'StudyController@viewUsers']);
    Route::post('studies/{studies}/users', ['as' => 'studies.users.set', 'uses' => 'StudyController@setUsers']);
    Route::get('studies/{studies}/requests', ['as' => 'studies.requests', 'uses' => 'StudyController@showRequestsForStudy']);
    Route::get('studies/{studies}/access', ['as' => 'studies.access', 'uses' => 'StudyController@showAccessData']);
    Route::get('studies/{studies}/access/print', ['as' => 'studies.access.p', 'uses' => 'StudyController@showAccessDataPrint']);
    Route::get('studies/{studies}/results', ['as' => 'studies.results', 'uses' => 'StudyController@showResults']);
    Route::get('studies/{studies}/copy', ['as' => 'studies.copy', 'uses' => 'StudyController@copyStudy']);
    Route::resource('studies', 'StudyController');

    Route::group(['before' => 'studystate_editable'], function(){
        Route::post('studies/{studies}/substudies/{substudies}/surveytime', ['as' => 'studies.substudies.surveytime.new', 'uses' => 'SubStudyController@newSurveyperiod']);
        Route::get('studies/{studies}/substudies/{substudies}/surveytime/{surveytime}', ['as' => 'studies.substudies.surveytime.edit', 'uses' => 'SubStudyController@editSurveyperiod']);
        Route::put('studies/{studies}/substudies/{substudies}/surveytime/{surveytime}', ['as' => 'studies.substudies.surveytime.update', 'uses' => 'SubStudyController@updateSurveyperiod']);
        Route::delete('studies/{studies}/substudies/{substudies}/surveytime/{surveytime}', ['as' => 'studies.substudies.surveytime.delete', 'uses' => 'SubStudyController@deleteSurveyperiod']);
        Route::resource('studies.substudies', 'SubStudyController');
        Route::get('studies/{studies}/substudies/{substudies}/questiongroups/order', ['as' => 'studies.substudies.questionsgroups.editorder', 'uses' => 'QuestionGroupController@editOrder']);
        Route::put('studies/{studies}/substudies/{substudies}/questiongroups/order', ['as' => 'studies.substudies.questionsgroups.updateorder', 'uses' => 'QuestionGroupController@updateOrder']);
        Route::resource('studies.substudies.questiongroups', 'QuestionGroupController');
        Route::get('studies/{studies}/substudies/{substudies}/questiongroups/{questiongroups}/order', ['as' => 'studies.substudies.questiongroups.questions.editorder', 'uses' => 'QuestionController@editOrder']);
        Route::put('studies/{studies}/substudies/{substudies}/questiongroups/{questiongroups}/order', ['as' => 'studies.substudies.questiongroups.questions.updateorder', 'uses' => 'QuestionController@updateOrder']);
        Route::resource('studies.substudies.questiongroups.questions', 'QuestionController');
        Route::resource('studies.substudies.questiongroups.rules', 'RulesController');
        Route::get('studies/{studies}/substudies/{substudies}/questiongroups/{questiongroups}/questions/{questions}/delete', ['uses' => 'QuestionController@destroy']);
    });

    /*
     * Study Access requests
     */
    Route::get('requests/new/{studyId}', ['as' => 'requests.new', 'uses' => 'StudyRequestController@newRequest']);
    Route::resource('requests', 'StudyRequestController', ['except' => ['create']]);
});

Route::group(['prefix' => 'api/v1'], function(){
    Route::get('testsubjects/new', function(){ return 'Hi';});
    Route::get('studydata/{id}', array('uses' => 'ApiController@getStudy'));
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
