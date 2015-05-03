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
			$substudy->version ? $substudy->version = $substudy->version + 1 : $substudy->version = 1;
			$substudy->study->version ? $substudy->study->version = $substudy->study->version + 1 : $substudy->study->version = 1;
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
			\Carbon\Carbon::MONDAY 		=> 'MO',
			\Carbon\Carbon::TUESDAY 	=> 'TU',
			\Carbon\Carbon::WEDNESDAY	=> 'WE',
			\Carbon\Carbon::THURSDAY	=> 'TH',
			\Carbon\Carbon::FRIDAY		=> 'FR',
			\Carbon\Carbon::SATURDAY	=> 'SA',
			\Carbon\Carbon::SUNDAY		=> 'SU'
		];

		$survey_times = [];

		if ($this->getTrigger() != 'EVENT')
		{
			foreach ($this->surveyperiods as $surv_per)
			{
				foreach ($this->surveyperiods as $surv_per) {
					$step_date = clone $surv_per->start_date;

					$start_date = clone $step_date;
					$end_time = clone $start_date;
					$end_time->addHour();

					$end_time->hour = $surv_per->end_date->hour;
					$end_time->minute = $surv_per->end_date->minute;
					$end_time->second = $surv_per->end_date->second;


					while ($step_date->lte($surv_per->end_date))
					{
						if ($surv_per->isDaySet($carbon_days[$step_date->dayOfWeek]))
						{

							while ($step_date->lte($end_time))
							{


								$add = $this->trigger_time_interval * 60;

								$step_date->addSeconds($add);

								if ($this->getTrigger() == 'FLEX')
								{
									$flex = mt_rand(0, $add) - ($add / 2);
									$step_date->addSeconds($flex);
								}

								$signal = [];
								$signal['id'] = count($survey_times);
								if ($step_date->lte($end_time))
								{
									$signal['time'] = $step_date->toDateTimeString();
									$survey_times[] = $signal;
								}
							}
						}
						$step_date->addDay();
						$end_time->addDay();
						$step_date->hour = $start_date->hour;
						$step_date->minute = $start_date->minute;
						$step_date->second = $start_date->second;
					}
				}
			}
		}

		return $survey_times;

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