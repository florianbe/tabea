<?php

use Tabea\Forms\UserForm;

class UsersController extends \BaseController {

	protected $userForm;

	function __construct(UserForm $userForm) 
	{
		$this->userForm = $userForm;
	}

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::where('is_admin', '=', false)->get();
		$admins = User::where('is_admin', '=', true)->get();
		return View::make('admin.users.index')->with('users', $users)->with('admins', $admins);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{

		
		try 
		{
			$this->userForm->validate(Input::only('first_name', 'last_name', 'email'));
			
			$password = (substr(md5(rand()),0,6));

			$user = new User;
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email = Input::get('email');
			$user->password = $password;
			$user->is_admin = Input::has('is_admin');		 
            $user->must_reset_password = true;
			$user->save();

			Mail::send('emails.auth.newuser', array('user'=>$user, 'password' => $password), function($message) use ($user){
    	    $message->to($user->email, $user->full_name)->subject( trans('pagestrings.users_mail_new_subject'));
    		});

            return Redirect::route('admin.users.index')->with('message', trans('pagestrings.users_create_success', ['full_name' => $user->full_name]));

		}
		catch (Laracasts\Validation\FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        try {
            $user = User::findOrFail($id);

            return View::make('admin.users.edit')->with('user', $user);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return 'User not found';
        }
    }

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $email = '';
        $user = User::findOrFail($id);

        try {

            //Save email during validation in temp variable - must be unique
            $email = $user->email;
            $user->email = "xaf@axud.af";
            $user->save();

            $this->userForm->validate(Input::only('first_name', 'last_name', 'email'));

            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');
            $user->is_admin = Input::has('is_admin');

            $user->save();

            return Redirect::route('admin.users.index')->with('message', trans('pagestrings.users_edit_success', ['name' => $user->full_name]));
        }
        catch (Laracasts\Validation\FormValidationException $e)
        {
            $user->email = $email;
            $user->save();
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

    }

    /**
     * Send a new password to user
     * POST /users/{users}/resend
     *
     * @param int $id
     * @return Response
     */
    public function resendPassword($id)
    {
        $user = User::findOrFail($id);
        $password = (substr(md5(rand()),0,6));
        $user->password = $password;
        $user->must_reset_password = true;

        $user->save();

        //Send info E-Mail
        Mail::send('emails.auth.resetpassword', array('user'=>$user, 'password' => $password), function($message) use ($user) {
            $message->to('florian.binoeder@gmail.com', $user->full_name)->subject( trans('pagestrings.users_mail_reset_subject'));
        });

        return Redirect::route('admin.users.index')->with('message', trans('pagestrings.users_edit_resend_success', ['name' => $user->full_name]));
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $user = User::findOrFail($id);

        $studies_authored = $user->studiesAuthored()->get();

        foreach($studies_authored as $study)
        {
            $study->author()->associate(Auth::user());
            $study->save();
        }

        $user->delete();

        return Redirect::route('admin.users.index')->with('message', trans('pagestrings.users_edit_delete_success', ['name' => $user->full_name]));

    }

}