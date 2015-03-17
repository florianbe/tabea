<?php

class QuestionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /question
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /question/create
	 *
	 * @return Response
	 */
	public function create($studies, $substudies, $questiongroups)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		$questiongroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', "=", $questiongroups)->firstOrFail();
		$questiontypes = QuestionType::all();
		$optiongroups = OptionGroup::where('is_predefined', '=', 1)->get();

		$questiondropdown = [];
		$optiondropdown = [];

		foreach($questiontypes as $questiontype)
		{
			$questiondropdown[$questiontype->code] = trans('pagestrings.question_typename_' . $questiontype->code);
		}

		foreach($optiongroups as $optiongroup)
		{
			$optiondropdown[$optiongroup->code] = trans('pagestrings.question_optiongroup_' . $optiongroup->code);
		}

		$optiondropdown['SELF'] = trans('pagestrings.question_optiongroup_SELF');


		return View::make('questions.create')->with(compact('questiongroup'))->with(compact('questiontypes'))->with(compact('questiondropdown'))->with(compact('optiondropdown'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /question
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /question/{id}
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
	 * GET /question/{id}/edit
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
	 * PUT /question/{id}
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
	 * DELETE /question/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}