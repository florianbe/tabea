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