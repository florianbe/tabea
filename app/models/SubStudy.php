<?php

class Substudy extends \Eloquent {
	protected $fillable = [];

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
}