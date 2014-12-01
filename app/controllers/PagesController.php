<?php

use Tabea\Forms\ProfileForm;

class PagesController extends \BaseController {

    protected $profileForm;

    function __construct(ProfileForm $profileForm)
    {
        $this->profileForm = $profileForm;
    }


    public function showHome()
    {
        return View::make('hello');
    }

	public function showProfile()
    {
        return View::make('pages.profile');
    }

    public function updateProfile()
    {

        try {

            //return Input::all();

            $this->profileForm->validate(Input::only('password', 'password_confirmation'));

            $user = Auth::user();
            $user->password = Input::get('password');
            $user->must_reset_password = false;

            $user->save();

            return Redirect::route('home')->with('message', trans('pagestrings.profile_password_success'));
        }
        catch (Laracasts\Validation\FormValidationException $e)
        {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }
    }



}