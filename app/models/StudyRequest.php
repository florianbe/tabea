<?php

class StudyRequest extends Eloquent {

    protected $table = 'requests';

    protected $fillable = [];

    public function study()
    {
        return $this->hasOne('Study');
    }
    public function requestingUser()
    {
        return $this->hasOne('User');
    }
}