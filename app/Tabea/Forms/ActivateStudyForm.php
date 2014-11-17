<?php namespace Tabea\Forms;

use Laracasts\Validation\FormValidator;

class ActivateStudyForm extends FormValidator {

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users'
    ];
}