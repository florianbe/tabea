<?php namespace Tabea\Forms;

class SubstudyForm extends BaseForm {

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'name' => 'required|unique:substudies,name,',
        'intervaltime' => 'integer|min:1'
    ];
}