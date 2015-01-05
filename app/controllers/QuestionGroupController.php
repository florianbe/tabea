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
		return View::make('questiongroups.index')->with(compact('substudy'))->with(['edit_questiongroup' => null]);
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
		return View::make('questiongroups.create')->with(compact('substudy'))->with(['edit_questiongroup' => null]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /questiongroup
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /questiongroup/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /questiongroup/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /questiongroup/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /questiongroup/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}