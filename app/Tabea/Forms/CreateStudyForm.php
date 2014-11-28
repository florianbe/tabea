<?php namespace Tabea\Forms;

class CreateStudyForm extends BaseForm {

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'name' => 'required|',
        'short_name' => 'required|max:20|unique:studies',
        'studypassword' => 'required',
        'accessible_from' => 'date|before:accessible_until',
        'accessible_until' => 'date',
        'uploadable_until' => 'date|after:accessible_from'
    ];

}