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
 * Profile
 */
Route::get('profile', array('as' => 'profile', function(){return 'user_profile';}));
Route::get('requests/list', array('as'=> 'requests', function() {return 'requests';}));

Route::get('generateTestStudy', function(){

    $study = new Study();

    $study->name = 'Long näme for ze test stüdy';
    $study->short_name = 'shortname';
    $study->description = 'BlubBlubBlubBlub';
    $study->comment = 'BlubComment';
    $study->password = 'secret';
    $study->accessible_from = Carbon\Carbon::now();
    $study->accessible_until = Carbon\Carbon::now();
    $study->answerable_from = Carbon\Carbon::now();
    $study->answerable_until = Carbon\Carbon::now();
    $study->uploadable_until = Carbon\Carbon::now();

    $studystate = StudyState::find(1);

    $study->studystate()->associate($studystate);
    $study->save();


    $study->users()->attach(Auth::user()->id, ['is_contributor' => true]);
    $study->users()->attach(6, ['is_contributor' => false]);
    $study->save();
    return $study;

});

Route::get('getUsers', function(){
    $study = Study::find(1);

    print '<ul>';
    foreach($study->contributors as $user){
        print '<li>' . $user->email . ' ' . $user->pivot->is_contributor . '</li>';
    }
    print '</ul>';


});

Route::group(array('before' => 'auth'), function(){
    Route::resource('studies', 'StudiesController');
    Route::get('studies', array('as' => 'studies', 'uses' => 'StudiesController@index'));
});

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
