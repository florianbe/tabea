<?php namespace Tabea\Forms;

class ProfileForm extends BaseForm {

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'password'  =>  'required|min:5|confirmed',
    ];

}