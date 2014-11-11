<?php

class StudyState extends Eloquent {

    protected $table = 'studystates';

    protected $fillable = [];

    public function studies()
    {
        return $this->hasMany('Study');
    }
}