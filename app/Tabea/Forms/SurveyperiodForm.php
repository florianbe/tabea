<?php namespace Tabea\Forms;

class SurveyperiodForm extends BaseForm {

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'surveyperiod_start' => 'required|date|',
        'surveyperiod_end' => 'integer|min:1'
    ];
}