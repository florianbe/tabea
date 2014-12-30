<?php

use Tabea\Forms\SubstudyForm;

class SubStudyController extends \BaseController {

	protected $substudyForm;

	function __construct(SubstudyForm $substudyForm)
	{
		$this->substudyForm = $substudyForm;

		$this->beforeFilter('auth');
		$this->beforeFilter('has_study_access');
		$this->beforeFilter('is_study_contributor_or_admin', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
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
			$this->substudyForm->setRules('name', $this->substudyForm->getRules('name') . $study->id);
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

			return Redirect::route('studies.substudies.edit', ['studies' => $study->id, 'substudies' => $substudy->id_in_study])->with('message', trans('pagestrings.ssubtudies_create_successmessage'));

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
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /substudy/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}