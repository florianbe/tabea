<?php namespace Tabea\Forms;

class SurveyperiodForm extends BaseForm {

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'surveyperiod_start'    => 'required|date|before:surveyperiod_end|after:',
        'surveyperiod_end'      => 'required|date|after:surveyperiod_start|before:'
    ];
}