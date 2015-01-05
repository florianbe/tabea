<?php

class QuestionGroup extends \Eloquent {
    protected $fillable = [];
    protected $table = 'questiongroups';

    public function SubStudy()
    {
        return $this->belongsTo('SubStudy', 'substudy_id');
    }

    public function Questions()
    {
        return $this->hasMany('Questions', 'questiontype_id', 'id');
    }

}