<?php

class QuestionGroup extends \Eloquent {
    protected $fillable = [];
    protected $table = 'questionrestrictions';

    public function Question()
    {
        return $this->belongsTo('Question', 'questionrestriction_id');
    }

}