<?php

class SubStudyController extends \BaseController {

	function __construct()
	{
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
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /substudy/{id}
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
	 * GET /substudy/{id}/edit
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
	 * PUT /substudy/{id}
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