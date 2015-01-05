<?php namespace Tabea\Forms;

class QuestionGroupForm extends BaseForm {

    /**
     * Validation rules for creating/updating the user object
     *
     * @var array
     */

    protected $rules = [
        'name' => 'required|unique:questiongroups,name,NULL,id,substudy_id,',
        'shortname' => 'required|unique:questiongroups,shortname,NULL,id,substudy_id,'
    ];
}