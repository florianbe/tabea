<?php

use Tabea\Forms\CreateStudyForm;
use Tabea\Forms\ActivateStudyForm;

class StudieController extends \BaseController {

    protected $createStudyForm;
    protected $activateStudyForm;

    function __construct(CreateStudyForm $createStudyForm, ActivateStudyForm $activateStudyForm)
    {
        $this->createStudyForm = $createStudyForm;
        $this->activateStudyForm = $activateStudyForm;

        $this->beforeFilter('auth');
        $this->beforeFilter('is_study_contributor', ['only' => ['edit', 'update']]);
        $this->beforeFilter('csrf', ['only' => 'post']);
    }
	/**
	 * Display a listing of the resource.
	 * GET /studies
	 *
	 * @return Response
	 */
	public function index()
	{
		$studies = Study::all();
        return View::make('studies.index')->with(compact('studies'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /studies/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('studies.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /studies
	 *
	 * @return Response
	 */
	public function store()
	{
        try
        {

            $this->createStudyForm->validate(Input::only('name', 'short_name', 'studypassword', 'accessible_from', 'accessible_until', 'uploadable_until'));

            $study = new Study;
            $study->fill(Input::only('name', 'short_name', 'studypassword', 'comment', 'description', 'accessible_from', 'accessible_until', 'uploadable_until'));

            $studystate = StudyState::where('code', '=', 'DESIGN')->firstOrFail();

            $study->studystate()->associate($studystate);
            $study->author()->associate(Auth::user());

            $study->save();
            return Redirect::route('studies')->with('message', trans('pagestrings.studies_create_successmessage'));
            
        }
        catch (Laracasts\Validation\FormValidationException $e)
        {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }
	}

	/**
	 * Display the specified resource.
	 * GET /studies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($studyId)
	{
        $study = Study::findOrFail($studyId);

        return View::make('studies.show')->with(compact('study'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /studies/{id}/edit
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
	 * PUT /studies/{id}
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
	 * DELETE /studies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}