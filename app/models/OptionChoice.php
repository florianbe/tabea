<?php

class OptionChoice extends \Eloquent
{
    protected $fillable = [];
    protected $table = 'optionchoices';

    public function OptionGroup()
    {
        return $this->belongsTo('OptionGroup', 'optiongroup_id');
    }

    public function Rules()
    {
        return $this->hasMany('Rule', 'optionchoice_id', 'id');
    }
}