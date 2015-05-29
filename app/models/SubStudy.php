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
			$substudy->study->version = $substudy->study->version ? $substudy->study->version + 1 : 1;
			$substudy->study->save();
			$substudy->version = $substudy->version ? $substudy->version + 1 : 1;

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

	public function Questions() {
		return $this->hasManyThrough('Question', 'QuestionGroup', 'id', 'questiongroup_id');
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

	public function getSumDatapoints() {

		$dp = [];

		foreach ($this->questiongroups as $qg) {
			foreach($qg->questions as $q) {
				foreach($q->answers as $a) {
					if (!in_array($q->testsubject_id . ';' . $q->signaled_at, $dp)) {
						$dp[] = $q->testsubject_id . ';' . $q->signaled_at;
					}
				}
			}
		}

		return count($dp);

	}

	public function getSumSubjects() {
		$dp = [];

		foreach ($this->questiongroups as $qg) {
			foreach($qg->questions as $q) {
				foreach($q->answers as $a) {
					if (!in_array($q->testsubject_id, $dp)) {
						$dp[] = $q->testsubject_id;
					}
				}
			}
		}

		return count($dp);
	}

	public function getAnswers() {
		$answers = [];

		foreach ($this->questiongroups as $qg) {
			foreach($qg->questions as $q) {
				foreach($q->answers as $a) {
					$ans = [];
					$ans['q_shortname'] 		= $q->shortname;
					$ans['q_text'] 				= $q->text;
					$ans['subject'] 			= $a->testsubject->getSubjectName();
					$ans['signaled_at'] 		= $a->signaled_at;
					$ans['answered_at'] 		= $a->answered_at;
					$ans['testanswer']			= $a->test ? 'JA' : 'NEIN';
					$ans['answer']				= $a->answer;

					$answers[]= $ans;
				}
			}
		}

		usort($answers, array($this, 'sortAnswers'));

		$csv_header = ['q_shortname' => 'Kurzbezeichnung Frage', 'q_text' => 'Frage', 'subject' => 'Proband', 'signaled_at' => 'Signal-/Antwortgruppe', 'answered_at' => 'Antwortzeit', 'testanswer' => 'Probelauf', 'answer' => 'Antwort'];
		array_unshift($answers, $csv_header);

		return $answers;
	}

	public function sortAnswers($a, $b) {

		// sort by last name
		$retval = strnatcmp($a['subject'], $b['subject']);
		// if last names are identical, sort by first name
		if(!$retval) $retval = strnatcmp($a['signaled_at'], $b['signaled_at']);
		return $retval;

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