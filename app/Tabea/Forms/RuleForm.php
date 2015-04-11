<?php namespace Tabea\Forms;

class RuleForm extends BaseForm
{

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'questiongroups'    => 'required|not_in:"0"',
        'questions'         => 'required|not_in:"0"',
        'answers'           => 'required|not_in:"0"'
    ];
}

