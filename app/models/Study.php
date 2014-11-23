<?php

class Study extends Eloquent
{

    protected $table = 'studies';

    protected $fillable = [
        'name', 'short_name',
        'description', 'comment',
        'studypassword', 'accessible_from',
        'accessible_until', 'uploadable_until'];

    protected $dates =[
        'accessible_from', 'accessible_until',
        'uploadable_until'
    ];

    public function setAccessibleFromAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['accessible_from'] = \Carbon\Carbon::createFromFormat('d.m.Y', $value)->toDateTimeString();
        }
    }
    public function setAccessibleUntilAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['accessible_until'] = \Carbon\Carbon::createFromFormat('d.m.Y', $value)->toDateTimeString();
        }
    }
    public function setUploadableUntilAttribute($value)
    {
        if ($value != null)
        {
            $this->attributes['uploadable_until'] = \Carbon\Carbon::createFromFormat('d.m.Y', $value)->toDateTimeString();
        }
    }

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

    public function studyRequests()
    {
        return $this->hasMany('StudyRequest');
    }

    public function getStudystateOptions()
    {
        $states = [];
        if ($this->studystate->code == 'DESIGN' || $this->studystate->code == 'PLANNED') {
            $states = [
                'DESIGN' => trans('pagestrings.studystate_design'),
                'PLANNED' => trans('pagestrings.studystate_planned'),
                'ARCHIVED' => trans('pagestrings.studystate_archived')
            ];
        } elseif ($this->studystate->code == 'RUNNING') {
            $states = [
                'RUNNING' => trans('pagestrings.studystate_running'),
                'CLOSED' => trans('pagestrings.studystate_closed'),
                'ARCHIVED' => trans('pagestrings.studystate_archived')
            ];
        } elseif ($this->studystate->code == 'CLOSED'){
            $states = [
            'CLOSED' => trans('pagestrings.studystate_closed'),
            'ARCHIVED' => trans('pagestrings.studystate_archived')
        ];}
        return $states;
    }

    public function isStudyEditable()
    {
        return ($this->studystate->code == 'DESIGN') ? true : false;
    }

    public function isStateEditable()
    {
        return ($this->studystate->code == 'ARCHIVED') ? false : true;
    }
}