<?php

class Answer extends \Eloquent {
    protected $fillable = [];
    protected $table = 'answers';


    public function Question()
    {
        return $this->belongsTo('Question', 'question_id');
    }



}