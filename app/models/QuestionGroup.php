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

    public function Rules()
    {
        return $this->hasMany('Rule', 'questiongroup_id');
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
        if ($this->rules)
        {
            foreach ($this->rules as $rule)
            {
                $rule->delete();
            }
        }

        return parent::delete();
    }

}