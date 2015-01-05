<?php

class OptionGroup extends \Eloquent {
    protected $fillable = [];
    protected $table = 'optiongroups';

    public function Questions()
    {
        return $this->hasMany('Questions', 'optiongroup_id');
    }

    public function OptionChoices()
    {
        return $this->hasMany('OptionChoice', 'optiongroup_id', 'id');
    }

}