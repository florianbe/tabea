<?php

use Tabea\Forms\SubstudyForm;
use Tabea\Forms\SurveyperiodForm;

class SubStudyController extends \BaseController {

	protected $substudyForm;
	protected $surveyperiodForm;

	function __construct(SubstudyForm $substudyForm, SurveyperiodForm $surveyperiodForm)
	{
		$this->substudyForm = $substudyForm;
		$this->surveyperiodForm = $surveyperiodForm;

		$this->beforeFilter('auth');
		$this->beforeFilter('has_study_access');
		$this->beforeFilter('is_study_contributor_or_admin', ['only' => ['create', 'store', 'edit', 'update', 'destroy', 'newSurveyperiod', 'editSurveyperiod', 'deleteSurveyperiod', 'updateSurveyperiod']]);
	}

	/**
	 * Display a listing of the resource.
	 * GET /substudy
	 *
	 * @return Response
	 */
	public function index($studies)
	{
		$study = Study::findOrFail($studies);

		return View::make('substudies.index')->with(compact('study'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /substudy/create
	 *
	 * @return Response
	 */
	public function create($studies)
	{
		$study = Study::findOrFail($studies);
		return View::make('substudies.create')->with(compact('study'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /substudy
	 *
	 * @return Response
	 */
	public function store($studies)
	{

		try
		{
			$study = Study::findOrFail($studies);
			//Add study id to validator to check for unique name on study level
			$this->substudyForm->setRules('name', $this->substudyForm->getRules('name') . 'NULL,id,study_id,' .  $study->id);
			//If signal is time-based intervaltime is mandatory
			if (Input::get('signaltype') == 'FIX'  || Input::get('signaltype') == 'FLEX')
			{
				$this->substudyForm->setRules('intervaltime', $this->substudyForm->getRules('intervaltime') . '|required');
			}

			$this->substudyForm->validate(Input::all());


			$substudy = new Substudy;
			$substudy->name = Input::get('name');
			$substudy->setTrigger(Input::get('signaltype'), Input::get('intervaltime'));
			$substudy->description = Input::get('description');
			$substudy->comment = Input::get('comment');

			$study->subStudies->count() <= 0 ? $substudy->id_in_study = 1 : $substudy->id_in_study = ($study->subStudies->max('id_in_study') + 1);

			$substudy->study()->associate($study);
			$substudy->save();

			return Redirect::route('studies.substudies.edit', ['studies' => $study->id, 'substudies' => $substudy->id_in_study, 'surveyperiod' => null])->with('message', trans('pagestrings.substudies_create_successmessage'));

		}
		catch (Laracasts\Validation\FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}


	}

	/**
	 * Display the specified resource.
	 * GET /substudy/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($studies, $substudies)
	{
		$study = Study::findOrFail($studies);
		$substudy = Substudy::where('study_id', '=', $study->id)->where('id_in_study', '=', $substudies)->firstOrFail();

		return View::make('substudies.show')->with(compact('substudy'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /substudy/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($studies, $substudies)
	{
		$study = Study::findOrFail($studies);
		$substudy = Substudy::where('study_id', '=', $study->id)->where('id_in_study', '=', $substudies)->firstOrFail();

		return View::make('substudies.edit')->with(compact('substudy'))->with(['surveyperiod' => null]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /substudy/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($studies, $substudies)
	{
		try
		{
			$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
			//Add study id to validator to check for unique name on study level
			$this->substudyForm->setRules('name', $this->substudyForm->getRules('name') . $substudy->id . ',id,study_id,' .  $substudy->study->id);

			//If signal is time-based intervaltime is mandatory
			if (Input::get('signaltype') == 'FIX'  || Input::get('signaltype') == 'FLEX')
			{
				$this->substudyForm->setRules('intervaltime', $this->substudyForm->getRules('intervaltime') . '|required');
			}

			$this->substudyForm->validate(Input::all());

			$substudy->name = Input::get('name');
			$substudy->setTrigger(Input::get('signaltype'), Input::get('intervaltime'));
			$substudy->description = Input::get('description');
			$substudy->comment = Input::get('comment');

			$substudy->save();

			return Redirect::route('studies.substudies.edit', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, 'surveyperiod' => null])->with('message', trans('pagestrings.substudies_edit_successmessage'));

		}
		catch (Laracasts\Validation\FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /substudy/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($studies, $substudies)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();


		if ($substudy->study->isStudyEditable()) {
			$substudy->delete();

			if (Request::ajax())
			{
				return 1;
			} else
			{
				return Redirect::route('studies.substudies.index', ['studies' => $substudy->study->id])->with('message', trans('pagestrings.substudy_delete_successmessage'));
			}
		}
	}

	public function newSurveyperiod($studies, $substudies)
	{
		try
		{

			$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();

			//Add Study access dates to validation
			$this->surveyperiodForm->setRules('surveyperiod_start', $this->surveyperiodForm->getRules('surveyperiod_start') . $substudy->study->accessible_from);
			$this->surveyperiodForm->setRules('surveyperiod_end', $this->surveyperiodForm->getRules('surveyperiod_end') . $substudy->study->accessible_until);
			$this->surveyperiodForm->validate(['surveyperiod_start' => str_replace('Uhr', '', Input::get('surveyperiod_start')), 'surveyperiod_end' => str_replace('Uhr', '', Input::get('surveyperiod_end'))]);

			$surveyPeriod = new SurveyPeriod;

			$surveyPeriod->start_date = trim(str_replace(' Uhr', '', Input::get('surveyperiod_start')));
			$surveyPeriod->end_date = trim(str_replace(' Uhr', '', Input::get('surveyperiod_end')));

			$substudy->SurveyPeriods->count() <= 0 ? $surveyPeriod->id_in_substudy = 1 : $surveyPeriod->id_in_substudy =  $substudy->SurveyPeriods->max('id_in_substudy') + 1;

			$days = $surveyPeriod->getWeekdays();

			foreach($days as $day => $set)
			{
				if (Input::has('ALLDAYS'))
				{
					$days[$day] = true;
				}
				elseif (Input::has('WEEKDAYS') && $day != 'SA' && $day != 'SU')
				{
					$days[$day] = true;
				}
				elseif (in_array($day, Input::get('days', [])))
				{
					$days[$day] = true;
				}
				else
				{
					$days[$day] = false;
				}
			}

			$surveyPeriod->setWeekdays($days);
			$surveyPeriod->substudy()->associate($substudy);

			$surveyPeriod->save();

			return Redirect::route('studies.substudies.edit', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, 'surveyperiod' => null])->with('message', trans('pagestrings.substudies_edit_surveyperiod_successmessage'));

		}
		catch (Laracasts\Validation\FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	public function editSurveyperiod($studies, $substudies, $surveytime)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		$surveyperiod = $substudy->SurveyPeriods()->where('id_in_substudy', '=', $surveytime)->firstOrFail();

		return View::make('substudies.edit', ['study' => $substudy->study, 'substudy' => $substudy, 'surveyperiod' => $surveyperiod]);
	}

	public function updateSurveyperiod($studies, $substudies, $surveytime)
	{
		try
		{
			$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
			$surveyPeriod = $substudy->SurveyPeriods()->where('id_in_substudy', '=', $surveytime)->firstOrFail();
			//Add Study access dates to validation
			$this->surveyperiodForm->setRules('surveyperiod_start', $this->surveyperiodForm->getRules('surveyperiod_start') . $substudy->study->accessible_from);
			$this->surveyperiodForm->setRules('surveyperiod_end', $this->surveyperiodForm->getRules('surveyperiod_end') . $substudy->study->accessible_until);
			$this->surveyperiodForm->validate(['surveyperiod_start' => str_replace('Uhr', '', Input::get('surveyperiod_start')), 'surveyperiod_end' => str_replace('Uhr', '', Input::get('surveyperiod_end'))]);



			$surveyPeriod->start_date = trim(str_replace(' Uhr', '', Input::get('surveyperiod_start')));
			$surveyPeriod->end_date = trim(str_replace(' Uhr', '', Input::get('surveyperiod_end')));

			$substudy->SurveyPeriods->count() <= 0 ? $surveyPeriod->id_in_substudy = 1 : $surveyPeriod->id_in_substudy =  $substudy->SurveyPeriods->max('id_in_substudy') + 1;

			$days = $surveyPeriod->getWeekdays();

			foreach($days as $day => $set)
			{
				if (Input::has('ALLDAYS'))
				{
					$days[$day] = true;
				}
				elseif (Input::has('WEEKDAYS') && $day != 'SA' && $day != 'SU')
				{
					$days[$day] = true;
				}
				elseif (in_array($day, Input::get('days', [])))
				{
					$days[$day] = true;
				}
				else
				{
					$days[$day] = false;
				}
			}

			$surveyPeriod->setWeekdays($days);
			$surveyPeriod->substudy()->associate($substudy);

			$surveyPeriod->save();

			return Redirect::route('studies.substudies.edit', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, 'surveyperiod' => null])->with('message', trans('pagestrings.substudies_edit_surveyperiod_successmessage'));

		}
		catch (Laracasts\Validation\FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	public function deleteSurveyperiod($studies, $substudies, $surveytime)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		$surveyperiod = $substudy->SurveyPeriods()->where('id_in_substudy', '=', $surveytime)->firstOrFail();

		if ($substudy->study->isStudyEditable()) {
			$surveyperiod->delete();

			if (Request::ajax())
			{
				return 1;
			} else
			{
				return Redirect::route('studies.substudies.edit', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, 'surveyperiod' => null])->with('message', trans('pagestrings.substudies_edit_surveyperiod_deletemessage'));
			}

		}
	}

}