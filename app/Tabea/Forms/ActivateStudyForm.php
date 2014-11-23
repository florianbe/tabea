<?php namespace Tabea\Forms;

use Laracasts\Validation\FormValidator;

class ActivateStudyForm extends FormValidator
{

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'name' => 'required|',
        'short_name' => 'required|max:20|unique:studies',
        'studypassword' => 'required',
        'accessible_from' => 'required|date|before:accessible_until',
        'accessible_until' => 'required|date',
        'uploadable_until' => 'required|date|after:accessible_from'
    ];
}