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
        $my_StudyRequests = Auth::user()->studyRequests;


        return $my_StudyRequests;

	}

	/**
	 * Store a newly created resource in storage.
	 * GET /studyrequest
	 *
	 * @return Response
	 */
	public function newRequest($id)
	{
        $study = Study::findOrFail($id);

        if (Auth::user()->hasAccessToStudy($study))
        {
            return Response::make('Unauthorized', 401);
        }

        $studyRequest = new StudyRequest;
        $studyRequest->study()->associate($study);
        $studyRequest->requestingUser()->associate(Auth::user());
        $studyRequest->is_viewed = false;
        $studyRequest->as_contributor = Input::has('as_contributor');

        $studyRequest->save();

        Mail::send('emails.newstudyrequest',[
            'author_name' => $study->author->full_name,
            'requesting_name' => Auth::user()->full_name,
            'link_torequest' => HTML::linkRoute('request.edit', trans('pagestrings.studyrequest_mailauthor_linkto'), [$studyRequest->id]),
            'study_name' => $study->name
            ], function($message, $study){
                $message->to('florian.binoeder@gmail.com', $study->author->full_name)->subject(trans('pagestrings.studyrequest_mailauthor_subject'));
        });

        return Redirect::back()->with('message', trans('pagestrings.studyrequest_create_success'));
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
		//
	}

}