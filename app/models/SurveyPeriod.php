<?php

class SurveyPeriod extends \Eloquent {
	protected $fillable = [];

	protected $dayCodes = ['MO', 'TU', 'WE', 'TH', 'FR', 'SA', 'SO'];

	protected $table = 'surveyperiods';

	public function setWeekdays($weekdays)
	{
		$setDays = '';
		foreach($weekdays as $day=>$set)
		{
			$setDays = $set ? $setDays . ';' . $day : $setDays;
		}

		$this->weekday_list = $setDays;
	}

	public function getWeekdays()
	{
		$setInDb = explode(';', $this->weekday_list);
		$setDays = [];

		foreach($this->dayCodes as $day)
		{
			$setDays[$day] = in_array($day, $setInDb);
		}

		return $setDays;
	}

	public function getDayCodes()
	{
		return $this->dayCodes;
	}

	public function SubStudy()
	{
		return $this->belongsTo('SubStudy');
	}
}