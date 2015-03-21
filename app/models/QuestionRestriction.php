<?php

class QuestionRestriction extends \Eloquent {
    protected $fillable = [];
    protected $table = 'questionrestrictions';

    public function Question()
    {
        return $this->belongsTo('Question', 'question_id');
    }

}