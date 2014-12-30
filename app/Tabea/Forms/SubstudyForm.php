<?php namespace Tabea\Forms;

class SubstudyForm extends BaseForm {

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'name' => 'required|unique:substudies,name,NULL,id,study_id,',
        'intervaltime' => 'integer|min:1'
    ];
}