<?php

class Request extends \Eloquent {

    protected $table = 'requests';

    protected $fillable = [];

    public function requestingUser()
    {
        return $this->belongsTo('User');
    }

    public function requestedStudy()
    {
        return $this->belongsTo('Study');
    }
}