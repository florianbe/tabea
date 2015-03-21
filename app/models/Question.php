<?php

class Question extends \Eloquent {
    protected $fillable = [];
    protected $table = 'questions';

    public function QuestionGroup()
    {
        return $this->belongsTo('QuestionGroup', 'questiongroup_id');
    }

    public function QuestionType()
    {
        return $this->belongsTo('QuestionType', 'questiontype_id');
    }

    public function QuestionRestrictions()
    {
        return $this->hasOne('QuestionRestrictions', 'question_id');
    }

    public function OptionGroup()
    {
        return $this->belongsTo('OptionGroup', 'optiongroup_id');
    }

}