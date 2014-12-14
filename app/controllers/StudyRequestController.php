<?php

class StudyRequestController extends \BaseController {

    public function __construct()
    {

    }
	/**
	 * Display a listing of the resource.
	 * GET /studyrequest
	 *
	 * @return Response
	 */
	public function index()
	{
        $my_StudyRequests = Auth::user()->studyrequests()->get();

        return View::make('studyrequests.index')->with(compact('my_StudyRequests'));
	}

	/**
	 * Store a newly created resource in storage.
	 * GET /studyrequest
	 *
	 * @return Response
	 */
	public function newRequest($studyId)
	{
        $study = Study::findOrFail($studyId);

        if (Auth::user()->hasAccessToStudy($study))
        {
            return Redirect::route('studies.index')->with('message', trans('pagestrings.studyrequest_create_already_access'));
        }
        if (Auth::user()->hasRequestForStudy($study))
        {
            return Redirect::route('studies.index')->with('message', trans('pagestrings.studyrequest_create_already_request'));
        }

        return View::make('studyrequests.create')->with(compact('study'));

	}

    public function store()
    {
        $study = Study::findOrFail(Input::get('studyId'));

        if (Auth::user()->hasAccessToStudy($study))
        {
            return Redirect::route('studies.index')->with('message', trans('pagestrings.studyrequest_create_already_access'));
        }
        if (Auth::user()->hasRequestForStudy($study))
        {
            return Redirect::route('studies.index')->with('message', trans('pagestrings.studyrequest_create_already_request'));
        }

        $studyRequest = new StudyRequest;
        $studyRequest->requestingUser()->associate(Auth::user());
        $studyRequest->study()->associate($study);
        $studyRequest->is_viewed = false;
        $studyRequest->is_accepted = false;
        $studyRequest->as_contributor = Input::has('as_contrib');
        $studyRequest->comment = Input::get('comment');

        $studyRequest->save();

        $link_request = HTML::linkRoute('requests.edit', trans('pagestrings.studyrequest_mailauthor_linkto'), ["request" => $studyRequest->id]);

        Mail::send('emails.newstudyrequest',[
            'author_name' => $study->author->full_name,
            'requesting_name' => Auth::user()->full_name,
            'link_torequest' => HTML::linkRoute('requests.edit', trans('pagestrings.studyrequest_mailauthor_linkto'), [$studyRequest->id]),
            'study_name' => $study->name
        ], function($message) use ($study, $link_request) {
            $message->to('florian.binoeder@gmail.com', $study->author->full_name)->subject(trans('pagestrings.studyrequest_mailauthor_subject'));
        });
        return Redirect::route('studies.index')->with('message', trans('pagestrings.studyrequest_create_success'));
    }

	/**
	 * Show the form for editing the specified resource.
	 * GET /studyrequest/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$studyRequest = StudyRequest::findOrFail($id);

        return $studyRequest;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /studyrequest/{id}
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
	 * DELETE /studyrequest/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $studyRequest = StudyRequest::findOrFail($id);

        if ($studyRequest->requestingUser()->first() == Auth::User())
        {
            $studyRequest->delete();
            $my_StudyRequests = Auth::user()->studyrequests()->get();

            return View::make('studyrequests.index')->with(compact('my_StudyRequests'));
        }
        else
        {
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException();
        }
	}

}