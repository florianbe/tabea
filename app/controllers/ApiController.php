<?php

class ApiController extends \BaseController {


	protected $studyTransformer;

	function __construct(\Tabea\Transformers\StudyTransformer $studyTransformer)
	{
		$this->studyTransformer = $studyTransformer;
	}

	public function getStudyId()
	{

		$data = [];



		try
		{
			if (Input::has('study') && Input::has('password'))
			{
				$short_name = Input::get('study');
				$studypassword = Input::get('password');

				$studies = Study::where('short_name', '=', $short_name)->where('studypassword', '=', $studypassword)->get();

				foreach ($studies as $study) {
					if ($study->studystate->code != 'CLOSED' && $study->studystate->code != 'ARCHIVED')
					{
						$data['study_id'] = intval($study->id);

						return Response::json(['data' => $data], 200);
					}
				}

				$error = [];
				$error['code'] = 404;
				$error['text'] = 'item not found';

				$data['error'] = $error;

				return Response::json(['data' => $data], 200);

			}
			else
			{
				$error = [];
				$error['code'] = 404;
				$error['text'] = 'item not found';

				$data['error'] = $error;

				return Response::json(['data' => $data], 200);
			}

		}
		catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			$error = [];
			$error['code'] = 404;
			$error['text'] = 'item not found';

			$data['error'] = $error;

			return Response::json([$data], 200);
		}



	}

	/**
	 * Display a listing of the resource.
	 * GET /api
	 *
	 * @return Response
	 */
	public function getStudy($id)
	{
		$study = Study::findOrFail($id);



		return Response::json([
			'data'	=>	$this->studyTransformer->transform($study)
			],200
		);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /api/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /api
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /api/{id}
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
	 * GET /api/{id}/edit
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
	 * PUT /api/{id}
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
	 * DELETE /api/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}