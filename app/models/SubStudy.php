<?php

class Substudy extends \Eloquent {
	protected $fillable = [];

	public function Study()
	{
		return $this->belongsTo('Study');
	}

	public function SurveyPeriods()
	{
		return $this->hasMany('SurveyPeriod');
	}
}