<?php

class Study extends Eloquent
{

    protected $table = 'studies';

    protected $fillable = [];

    public function studystate()
    {
        return $this->belongsTo('StudyState');
    }

    public function author()
    {
        return $this->belongsTo('User');
    }

    public function users()
    {
        return $this->belongsToMany('User', 'user_study', 'study_id', 'user_id')->withPivot('is_contributor')->withTimestamps();
    }

    public function contributors()
    {
        return $this->belongsToMany('User', 'user_study', 'study_id', 'user_id')->withPivot('is_contributor')->where('is_contributor', '=', '1');
    }

    public function readAccessUsers()
    {
        return $this->belongsToMany('User', 'user_study', 'study_id', 'user_id')->withPivot('is_contributor')->where('is_contributor', '=', '0');
    }

    public function userRequests()
    {
        return $this->hasMany('Request');
    }
}