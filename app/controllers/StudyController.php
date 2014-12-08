<?php

use Tabea\Forms\CreateStudyForm;
use Tabea\Forms\ActivateStudyForm;

class StudyController extends \BaseController {

    protected $createStudyForm;
    protected $activateStudyForm;

    function __construct(CreateStudyForm $createStudyForm, ActivateStudyForm $activateStudyForm)
    {
        $this->createStudyForm = $createStudyForm;
        $this->activateStudyForm = $activateStudyForm;

        $this->beforeFilter('auth');
        $this->beforeFilter('is_study_contributor_or_admin', ['only' => ['edit', 'update']]);
        $this->beforeFilter('is_study_contributor_or_admin', ['only' => ['viewUsers', 'setUsers']]);

    }
	/**
	 * Display a listing of the resource.
	 * GET /study
	 *
	 * @return Response
	 */
	public function index()
	{
		$studies = Study::all();
        return View::make('study.index')->with(compact('studies'));
	}

    public function myStudies()
    {

        $studies_authored = Auth::user()->studiesAuthored()->get();
        $studies_contributing  = Auth::user()->studiesContributing()->get();
        $studies_readable = Auth::user()->studiesReadable();

        $studies_my = [
            trans('pagestrings.studies_role_author')        => $studies_authored,
            trans('pagestrings.studies_role_contributor')   => $studies_contributing,
            trans('pagestrings.studies_role_reading')       => $studies_readable];

        return View::make('study.mystudies')->with(compact('studies_my'));
    }
	/**
	 * Show the form for creating a new resource.
	 * GET /study/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('study.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /study
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
            return Redirect::route('study.edit', ['study' => $study->id])->with('message', trans('pagestrings.studies_create_successmessage'));
            
        }
        catch (Laracasts\Validation\FormValidationException $e)
        {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }
	}

	/**
	 * Display the specified resource.
	 * GET /study/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($studyId)
	{
        $study = Study::findOrFail($studyId);

        return View::make('study.show')->with(compact('study'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /study/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($studyId)
	{
		$study = Study::findOrFail($studyId);

        return View::make('study.edit')->with(compact('study'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /study/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($studyId)
	{
        try
        {
            $study = Study::findOrFail($studyId);
            $studyStateCode = Input::get('studystate');

            //Prevent invalid studystates
            if (!array_key_exists($studyStateCode, $study->getStudystateOptions())) { throw new Exception('invalid study state in put request');}
            $studystate = StudyState::where('code', '=', $studyStateCode)->firstOrFail();

            //Update validation rules to prevent errors on unique fields - add id as parameter
            $this->createStudyForm->setRules('short_name', $this->createStudyForm->getRules('short_name') . ',id');
            $this->activateStudyForm->setRules('short_name', $this->activateStudyForm->getRules('short_name') . ',id');

            if ($study->isStudyEditable())
            {
                $input = Input::only('name', 'short_name', 'studypassword', 'description', 'comment', 'accessible_from', 'accessible_until', 'uploadable_until');

                //Complete validation if studystate is change to planned, otherwise "soft" validation
                if ($studyStateCode == 'PLANNED') {
                    $this->activateStudyForm->validate($input);
                    //TODO: Validate substudies: at least one, all must validate itself

                }
                else {
                    $this->createStudyForm->validate($input);
                }

                $study->fill($input);
                $study->studystate()->associate($studystate);
            }

            else if ($study->isStateEditable())
            {
                $study->studystate()->associate($studystate);
            }

            $study->save();

            return Redirect::route('study.show', ['study' => $study->id])->with('message', trans('pagestrings.studies_create_successmessage'));
        }
        catch (Laracasts\Validation\FormValidationException $e)
        {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }
	}

    public function viewUsers($studyId)
    {
        $study = Study::findOrFail($studyId);
        $users = User::all();
        //Remove author, should not be deletable
        $users = $users->diff([Auth::user()]);
        $users = $users->diff($study->contributors()->get());
        $users = $users->diff($study->readAccessUsers()->get());

        $users_to_roles = [
            "contributors"  => $study->contributors()->get(),
            "readers"       => $study->readAccessUsers()->get(),
            "none"          => $users
        ];

        return View::make('study.access')->with(compact('users_to_roles', 'study'));
    }

    public function setUsers($studyId)
    {
        $study = Study::findOrFail($studyId);
        $study->readAccessUsers()->detach();

        //Contrib rights supercede read rights, calculate diff
        $access_rights = [
            "false"     => array_diff(Input::get('read'), Input::get('contrib')),
            "true"      => Input::get('contrib')
        ];

        foreach ($access_rights as $right => $userGroup)
        {
            foreach ($userGroup as $userId) {
                $user = User::findOrFail($userId);
                $study->users()->attach($userId, ['is_contributor' => $right=='true' ? 1 : 0]);
            }
        }

        return Redirect::route('study.show', ['study' => $study->id])->with('message', trans('pagestrings.study_access_set_success'));
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /study/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}