<?php

class SurveyPeriod extends \Eloquent {
	protected $fillable = [];

	public function SubStudy()
	{
		return $this->belongsTo('SubStudy');
	}
}