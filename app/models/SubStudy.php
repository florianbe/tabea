<?php

class Substudy extends \Eloquent {
	protected $fillable = [];

	public static function boot()
	{
		parent::boot();

		// Attach event handler, on saving
		Substudy::saving(function($substudy)
		{
			//Touch associated Study
			$substudy->study->touch();

		});
	}

	public function Study()
	{
		return $this->belongsTo('Study');
	}

	public function SurveyPeriods()
	{
		return $this->hasMany('SurveyPeriod', 'substudy_id', 'id');

	}

	public function QuestionGroups()
	{
		return $this->hasMany('QuestionGroup', 'substudy_id', 'id')->orderBy('sequence_indicator', 'ASC');;
	}

	public function setTrigger($triggerType, $timeInterval=0)
	{
		if ($triggerType == 'EVENT')
		{
			$this->trigger_is_event = true;
			$this->trigger_is_timefix = false;
			$this->trigger_time_interval = 0;
		}
		else
		{
			$this->trigger_time_interval = $timeInterval;
			$this->trigger_is_event = false;
			$triggerType == 'FIX' ? $this->trigger_is_timefix = true : $this->trigger_is_timefix = false;
		}
	}

	public function getTrigger()
	{
		if ($this->trigger_is_event == true)
		{
			return 'EVENT';
		}
		if ($this->trigger_is_event == false && $this->trigger_is_timefix == true)
		{
			return 'FIX';
		}
		if ($this->trigger_is_event == false && $this->trigger_is_timefix == false)
		{
			return 'FLEX';
		}
	}

	public function getTriggerName()
	{
		if ($this->trigger_is_event == true) {
			return trans('pagestrings.substudies_signal_event');
		}
		if ($this->trigger_is_event == false && $this->trigger_is_timefix == true) {
			return trans('pagestrings.substudies_signal_timefix');
		}
		if ($this->trigger_is_event == false && $this->trigger_is_timefix == false) {
			return trans('pagestrings.substudies_signal_timeflex');
		}
	}
	public function getTriggerInterval()
	{
		return $this->trigger_is_event ? 0 : $this->trigger_time_interval;
	}

	public function getSurveyTimes()
	{

		$carbon_days = [
			'MO'	=> \Carbon\Carbon::MONDAY,
			'TU' 	=> \Carbon\Carbon::TUESDAY,
			'WE'	=> \Carbon\Carbon::WEDNESDAY,
			'TH'	=> \Carbon\Carbon::THURSDAY,
			'FR'	=> \Carbon\Carbon::FRIDAY,
			'SA'	=> \Carbon\Carbon::SATURDAY,
			'SU'	=> \Carbon\Carbon::SUNDAY
		];

		$survey_times = [];

		if ($this->getTrigger() != 'EVENT')
		{
			foreach ($this->surveyperiods as $surv_per)
			{
				$signals = [];
				foreach ($this->surveyperiods as $surv_per) {

					$step_date = $surv_per->start_date;
					$step_time = $surv_per->start_date;

					while ($step_date <= $surv_per->end_date)
					{

					}

				}
			}
		}

	}

	public function delete()
	{
		if ($this->surveyperiods)
		{
			foreach ($this->surveyperiods as $survper)
			{
				$survper->delete();
			}
		}
		if ($this->questiongroups)
		{
			foreach ($this->questiongroups as $quegr)
			{
				$quegr->delete();
			}
		}

		return parent::delete();
	}

	public function copy_to_study(Study $target_study)
	{
		$substudy = new Substudy;
		$substudy->id_in_study = $this->id_in_study;
		$substudy->name = $this->name;
		$substudy->description = $this->description;
		$substudy->comment = $this->comment;
		$substudy->sequence_indicator = $this->sequence_indicator;
		$substudy->trigger_is_event = $this->trigger_is_event;
		$substudy->trigger_is_timefix = $this->trigger_is_timefix;
		$substudy->trigger_time_interval = $this->trigger_time_interval;

		$substudy->study()->associate($target_study);
		$substudy->save();

		foreach ($this->questiongroups as $questiongroup)
		{
			$questiongroup->copy_to_substudy($substudy);
		}

		$substudy->save();
	}
}