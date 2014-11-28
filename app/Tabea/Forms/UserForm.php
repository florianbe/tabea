<?php namespace Tabea\Forms;

class UserForm extends BaseForm {

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