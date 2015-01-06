<?php

class SessionsController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 * GET /sessions/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//Create first admin from config if none exist
		if (count(User::where('is_admin', '=', true)->get()) <= 0)
		{
			$user = new User;
			$user->first_name = Config::get( 'credentials.admin_firstname' );
			$user->last_name = Config::get( 'credentials.admin_lastname' );
			$user->email = Config::get( 'credentials.admin_mail' );
			$user->password = Config::get( 'credentials.admin_password' );
			$user->is_admin = true;
			$user->must_reset_password = true;
			$user->save();
		}

		return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sessions
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::only('email', 'password');

		if (Auth::attempt($input))
		{
            if(Auth::user()->must_reset_password)
            {
                return Redirect::route('profile.show')->with('message', trans('pagestrings.profile_change_password'));
            }
			return Redirect::intended(route('home'));
		}

		return Redirect::back()->withInput()->with('message', trans('pagestrings.login_error'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /sessions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id=null)
	{
		Auth::logout();

		return Redirect::route('login')->with('message', trans('pagestrings.logout_success'));
	}

}