<?php

use Tabea\Forms\QuestionGroupForm;


class QuestionGroupController extends \BaseController {


	protected $questionGroupForm;

	function __construct(QuestionGroupForm $questionGroupForm)
	{
		$this->questionGroupForm = $questionGroupForm;

		$this->beforeFilter('auth');
		$this->beforeFilter('has_study_access');
		$this->beforeFilter('is_study_contributor_or_admin', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 * GET /questiongroup
	 *
	 * @return Response
	 */
	public function index($studies, $substudies)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();

		return View::make('questiongroups.index')->with(compact('substudy'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /questiongroup/create
	 *
	 * @return Response
	 */
	public function create($studies, $substudies)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		return View::make('questiongroups.create')->with(compact('substudy'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /questiongroup
	 *
	 * @return Response
	 */
	public function store($studies, $substudies)
	{
		try
		{
			$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();

			//Add substudy id to validator to check for unique name on study level
			$this->questionGroupForm->setRules('name', $this->questionGroupForm->getRules('name') . 'NULL,id,substudy_id,' .  $substudy->id);
			$this->questionGroupForm->setRules('shortname', $this->questionGroupForm->getRules('shortname') . 'NULL,id,substudy_id,' .  $substudy->id);

			$this->questionGroupForm->validate(Input::all());

			$questionGroup = new QuestionGroup;

			$questionGroup->name = Input::get('name');
			$questionGroup->shortname = Input::get('shortname');

			$questionGroup->description = Input::get('description');
			$questionGroup->comment = Input::get('comment');
			$questionGroup->random_questionorder = Input::has('random_questionorder');

			$substudy->questionGroups->count() <= 0 ? $questionGroup->id_in_substudy = 1 : $questionGroup->id_in_substudy = ($substudy->questionGroups->max('id_in_substudy') + 1);

			$questionGroup->sequence_indicator = $substudy->questionGroups->count() + 1;


			$questionGroup->SubStudy()->associate($substudy);
			$questionGroup->save();


			return Redirect::route('studies.substudies.questiongroups.show', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, 'questiongroup' => $questionGroup->id_in_substudy])->with('message', trans('pagestrings.substudies_create_successmessage'));

		}
		catch (Laracasts\Validation\FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Display the specified resource.
	 * GET /questiongroup/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($studies, $substudies, $questiongroups)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		$questionGroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', '=', $questiongroups)->firstOrFail();

		return View::make('questiongroups.show')->with(['questiongroup' => $questionGroup]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /questiongroup/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($studies, $substudies, $questiongroups)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		$questionGroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', '=', $questiongroups)->firstOrFail();
		return View::make('questiongroups.edit')->with(['questiongroup' => $questionGroup]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /questiongroup/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($studies, $substudies, $questiongroups)
	{
		try
		{

			$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
			$questionGroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', '=', $questiongroups)->firstOrFail();

			//Add substudy id to validator to check for unique name on study level
			$this->questionGroupForm->setRules('name', $this->questionGroupForm->getRules('name') . $questionGroup->id . ',id,substudy_id,' .  $substudy->id);
			$this->questionGroupForm->setRules('shortname', $this->questionGroupForm->getRules('shortname') . $questionGroup->id . ',id,substudy_id,' .  $substudy->id);

			$this->questionGroupForm->validate(Input::all());


			$questionGroup->name = Input::get('name');
			$questionGroup->shortname = Input::get('shortname');

			$questionGroup->description = Input::get('description');
			$questionGroup->comment = Input::get('comment');
			$questionGroup->random_questionorder = Input::has('random_questionorder');

			$questionGroup->save();

			return Redirect::route('studies.substudies.questiongroups.show', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, 'questiongroup' => $questionGroup->id_in_substudy])->with('message', trans('pagestrings.substudies_edit_successmessage'));

		}
		catch (Laracasts\Validation\FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /questiongroup/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($studies, $substudies, $questiongroups)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		$questionGroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', '=', $questiongroups)->firstOrFail();

		if ($substudy->study->isStudyEditable()) {
			$questionGroup->delete();

			if (Request::ajax())
			{
				return 1;
			} else
			{
				return Redirect::route('studies.substudies.questiongroups.index', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study])->with('message', trans('pagestrings.questiongroup_delete_successmessage'));
			}
		}
	}


	public function editOrder($studies, $substudies)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		return View::make('questiongroups.order')->with(compact('substudy'));
	}

	public function updateOrder($studies, $substudies)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		$substudy_order = Input::get('substudy_order');

		asort($substudy_order);

		$sequence_order = 1;

		foreach($substudy_order as $qg_id_in_substudy => $order)
		{
			$questionGroup = $substudy->questiongroups->filter(function($item) use ($qg_id_in_substudy) { return $item->id_in_substudy == $qg_id_in_substudy; })->first();
			$questionGroup->sequence_indicator = $sequence_order;
			$questionGroup->save();
			$sequence_order = $sequence_order +1;
		}

		return Redirect::route('studies.substudies.questiongroups.index', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study ])->with('message', trans('pagestrings.questiongroup_editorder_successmessage'));
	}

}