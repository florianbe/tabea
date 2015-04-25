<?php

class SurveyPeriod extends \Eloquent
{
	protected $fillable = [];

	protected $dayCodes = ['MO', 'TU', 'WE', 'TH', 'FR', 'SA', 'SU'];

	protected $table = 'surveyperiods';

	protected $dates = [
		'start_date', 'end_date'
	];

	public static function boot()
	{
		parent::boot();

		// Attach event handler, on saving
		SurveyPeriod::saving(function($surveyperiod)
		{
			//Touch associated Study
			$surveyperiod->substudy->study->touch();

		});
	}

	public function setStartDateAttribute($value)
	{
		if ($value != null) {
			$this->attributes['start_date'] = \Carbon\Carbon::createFromFormat('d.m.Y H:i', $value)->toDateTimeString();
		}
	}

	public function setEndDateAttribute($value)
	{
		if ($value != null) {
			$this->attributes['end_date'] = \Carbon\Carbon::createFromFormat('d.m.Y H:i', $value)->toDateTimeString();
		}
	}

	public function setWeekdays($weekdays)
	{
		$setDays = '';
		foreach ($weekdays as $day => $set) {
			$setDays = $set ? $setDays . ';' . $day : $setDays;
		}

		$this->weekday_list = $setDays;
	}

	public function getWeekdays()
	{
		$setInDb = explode(';', $this->weekday_list);
		$setDays = [];

		foreach ($this->dayCodes as $day) {
			$setDays[$day] = in_array($day, $setInDb);
		}

		return $setDays;
	}

	public function getDayCodes()
	{
		return $this->dayCodes;
	}

	public function isDaySet($daycode)
	{
		$weekdays = $this->getWeekdays();

		return $weekdays[$daycode];
	}

	public function isDaySetIso($integer)
	{
		$weekdays = $this->getWeekdays();
		$keys = array_keys($weekdays);
		return $weekdays[$keys[$integer -1]];
	}

	public function SubStudy()
	{
		return $this->belongsTo('SubStudy', 'substudy_id');
	}

	public function getStartTime()
	{
		\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date);
	}

	public function getEndTime()
	{
		\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date);
	}

}