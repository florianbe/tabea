<?php

class TestSubject extends \Eloquent
{
    protected $fillable = [];

    protected $table = 'testsubjects';


    public function getSubjectName()
    {
        return $this->name_text . '_' . $this->name_counter;
    }
}