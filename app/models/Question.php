<?php

class Question extends \Eloquent {
    protected $fillable = [];
    protected $table = 'questions';

    public function Question()
    {
        return $this->belongsTo('QuestionGroup', 'questiongroup_id');
    }

    public function QuestionType()
    {
        return $this->belongsTo('QuestionType', 'questiontype_id');
    }

    public function QuestionRestrictions()
    {
        return $this->belongsTo('QuestionRestrictions', 'questionrestriction_id');
    }

    public function OptionGroup()
    {
        return $this->belongsTo('OptionGroup', 'optionsgroup_id');
    }

}