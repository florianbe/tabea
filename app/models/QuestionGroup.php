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
        return $this->hasMany('Question', 'questiongroup_id', 'id')->orderBy('sequence_indicator', 'ASC');
    }

    public function delete()
    {
        if ($this->questions)
        {
            foreach ($this->questions as $que)
            {
                $que->delete();
            }
        }

        return parent::delete();
    }

}