<?php

use Tabea\Forms\CreateStudyForm;
use Tabea\Forms\ActivateStudyForm;

class StudyController extends \BaseController
{

    protected $createStudyForm;
    protected $activateStudyForm;

    function __construct(CreateStudyForm $createStudyForm, ActivateStudyForm $activateStudyForm)
    {
        $this->createStudyForm = $createStudyForm;
        $this->activateStudyForm = $activateStudyForm;

        $this->beforeFilter('auth');
        $this->beforeFilter('is_study_contributor_or_admin', ['only' => ['edit', 'update', 'destroy', 'viewUsers', 'setUsers', 'showRequestsForStudy']]);
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

        return View::make('studies.index')->with(compact('studies'));
    }

    public function myStudies()
    {

        $studies_authored = Auth::user()->studiesAuthored()->get();
        $studies_contributing = Auth::user()->studiesContributing()->get();
        $studies_readable = Auth::user()->studiesReadable()->get();

        $studies_my = [
            trans('pagestrings.studies_role_author') => $studies_authored,
            trans('pagestrings.studies_role_contributor') => $studies_contributing,
            trans('pagestrings.studies_role_reading') => $studies_readable];

        return View::make('studies.mystudies')->with(compact('studies_my'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /study/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('studies.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /study
     *
     * @return Response
     */
    public function store()
    {
        try {
            $this->createStudyForm->validate(Input::only('name', 'short_name', 'studypassword', 'accessible_from', 'accessible_until', 'uploadable_until'));

            $study = new Study;
            $study->fill(Input::only('name', 'short_name', 'studypassword', 'comment', 'description', 'accessible_from', 'accessible_until', 'uploadable_until'));

            $studystate = StudyState::where('code', '=', 'DESIGN')->firstOrFail();
            $study->version = 1;

            $study->studystate()->associate($studystate);
            $study->author()->associate(Auth::user());

            $study->save();
            return Redirect::route('studies.edit', ['study' => $study->id])->with('message', trans('pagestrings.studies_create_successmessage'))->with('val_msg', null);

        } catch (Laracasts\Validation\FormValidationException $e) {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }
    }

    /**
     * Display the specified resource.
     * GET /study/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($studies)
    {
        $study = Study::findOrFail($studies);

        return View::make('studies.show')->with(compact('study'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /study/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($studies)
    {
        $study = Study::findOrFail($studies);

        return View::make('studies.edit')->with(compact('study'))->with('val_msg', null);
    }

    /**
     * Update the specified resource in storage.
     * PUT /study/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($studies)
    {
        try {
            $study = Study::findOrFail($studies);
            $studyStateCode = Input::get('studystate');

            //Prevent invalid studystates
            if (!array_key_exists($studyStateCode, $study->getStudystateOptions())) {
                throw new Exception('invalid study state in put request');
            }
            $studystate = StudyState::where('code', '=', $studyStateCode)->firstOrFail();

            //Update validation rules to prevent errors on unique fields - add id as parameter
            $this->createStudyForm->setRules('short_name', $this->createStudyForm->getRules('short_name') . ',id');
            $this->activateStudyForm->setRules('short_name', $this->activateStudyForm->getRules('short_name') . ',id');

            if ($study->isStudyEditable()) {
                $input = Input::only('name', 'short_name', 'studypassword', 'description', 'comment', 'accessible_from', 'accessible_until', 'uploadable_until');

                //Complete validation if studystate is change to planned, otherwise "soft" validation
                if ($studystate->code == 'PLANNED') {

                    $this->activateStudyForm->validate($input);
                    $val_msg = '';


                    if (count($study->substudies) <= 0)
                    {
                        $val_msg = $val_msg . '<br/>' . $study->name . ': ' . trans('pagestrings.studies_validate_substudy_none');
                    }
                    else
                    {
                        foreach ($study->substudies as $su_stu)
                        {
                            if ($su_stu->getTrigger() != 'EVENT' && count($su_stu->surveyperiods) <= 0)
                            {
                                $val_msg = $val_msg . '<br/>' . $su_stu->name . ': ' . trans('pagestrings.studies_validate_surveytime_none');
                            }

                            if (count($su_stu->questiongroups) <= 0)
                            {
                                $val_msg = $val_msg . '<br/>' . $su_stu->name . ': ' . trans('pagestrings.studies_validate_questiongroups_none');
                            }
                            else
                            {
                                foreach ($su_stu->questiongroups as $qu_gr) {
                                    if (count($qu_gr->questions) <= 0)
                                    {
                                        $val_msg = $val_msg . '<br/>' . $qu_gr->name . ': ' . trans('pagestrings.studies_validate_questions_none');
                                    }
                                }
                            }
                        }
                    }

                    if (strlen($val_msg) > 1)
                    {
                        Session::flash('object_validation', $val_msg);
                        return Redirect::back()->withInput();
                    }
                } else {
                    $this->createStudyForm->validate($input);
                }

                $study->fill($input);
                $study->studystate()->associate($studystate);
            } else if ($study->isStateEditable()) {
                $study->studystate()->associate($studystate);
            }
            $study->version = $study->version + 1;
            $study->save();

            return Redirect::route('studies.show', ['study' => $study->id])->with('message', trans('pagestrings.studies_edit_successmessage'))->with('val_msg', null);
        } catch (Laracasts\Validation\FormValidationException $e) {
            return Redirect::back()->withInput()->withErrors($e->getErrors())->with('val_msg', null);
        }
    }

    public function viewUsers($studies)
    {
        $study = Study::findOrFail($studies);
        $users = User::all();
        //Remove author, should not be deletable
        $users = $users->diff([Auth::user()]);
        $users = $users->diff($study->contributors()->get());
        $users = $users->diff($study->readAccessUsers()->get());

        $users_to_roles = [
            "contributors" => $study->contributors()->get(),
            "readers" => $study->readAccessUsers()->get(),
            "none" => $users
        ];

        return View::make('studies.access')->with(compact('users_to_roles', 'study'));
    }

    public function setUsers($studies)
    {
        $study = Study::findOrFail($studies);
        $study->readAccessUsers()->detach();

        //Contrib rights supercede read rights, calculate diff
        $access_rights = [
            "false" => array_diff(Input::get('read', []), Input::get('contrib', [])),
            "true" => Input::get('contrib', [])
        ];

        foreach ($access_rights as $right => $userGroup) {
            foreach ($userGroup as $userId) {
                $user = User::findOrFail($userId);
                $study->users()->attach($userId, ['is_contributor' => $right == 'true' ? 1 : 0]);
            }
        }

        return Redirect::route('studies.show', ['study' => $study->id])->with('message', trans('pagestrings.study_access_set_success'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /study/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($studies)
    {
        $study = Study::findOrFail($studies);

        if ($study->canDeleteStudy(Auth::user()))
        {
            $study->delete();

            if (Request::ajax())
            {
                return 1;
            } else
            {
                return Redirect::route('studies.index')->with('message', trans('pagestrings.studies_delete_successmessage'));
            }
        }
        else
        {
            return 'unauthorized';
        }

    }

    public function showRequestsForStudy($studies)
    {
        $studyRequests = StudyRequest::where('study_id', $studies)->get();
        $study = Study::findOrFail($studies);

        return View::make('studies.studyrequests')->with(compact('studyRequests'))->with(compact('study'));
    }

    public function showAccessData($studies)
    {
        $study = Study::findOrFail($studies);

        return View::make('studies.accessdata')->with(compact('study'));
    }

    public function showAccessDataPrint($studies)
    {
        $study = Study::findOrFail($studies);

        return View::make('studies.accessdata_print')->with(compact('study'));
    }

    public function showResults($studies)
    {
        $study = Study::findOrFail($studies);



        return View::make('studies.results')->with(compact('study'));

    }

    public function copyStudy($studies)
    {
        $study = Study::findOrFail($studies);

        $copied_study = $study->copy();

        return Redirect::route('studies.show', ['study' => $copied_study->id])->with('message', trans('pagestrings.studies_copy_successmessage'));
    }

}