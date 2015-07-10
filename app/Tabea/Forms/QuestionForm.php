<?php namespace Tabea\Forms;

class QuestionForm extends BaseForm
{

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'shortname' => 'required|max:20|unique:questions,shortname,',
        'text'          => 'required',
        'questiontype'  => 'required',
        'min_numeric'   => 'numeric',
        'max_numeric'   => 'numeric|greater_than:min_numeric',
        'step_numeric'  => 'numeric|stepbetween:min_numeric,max_numeric',
        'min_integer'   => 'integer',
        'max_integer'   => 'integer|greater_than:min_integer',
        'selfdef_choice' => 'userdefined_options:max_integer',
        'LIKERT_4'       => '',
        'LIKERT_5'       => '',
        'LIKERT_6'       => '',
        'LIKERT_7'       => '',
        'LIKERT_10'       => ''

    ];
}