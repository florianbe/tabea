<?php

class StudyRequest extends Eloquent {

    protected $table = 'requests';

    protected $fillable = [];

    public function study()
    {
        return $this->belongsTo('Study');
    }
    public function requestingUser()
    {
        return $this->belongsTo('User', 'user_id');
    }
}