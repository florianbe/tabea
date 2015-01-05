<?php

class QuestionType extends \Eloquent {
    protected $fillable = [];
    protected $table = 'questiontypes';

    public function Questions()
    {
        return $this->belongsToMany('QuestionGroup', 'questiongroup_id');
    }

}