<?php

class ApiController extends \BaseController {


	protected $studyTransformer;
	protected $error_messages = [
		'not_found'		=>	[ 'code' => 484, 'message' => 'item not found'],
		'unauthorized'	=>	[ 'code' => 481, 'message' => 'user not authorized'],
		'deprecated'	=>	[ 'code' => 486, 'message' => 'deprecated study version']
	];

	protected $headers = [
		'Access-Control-Allow-Origin'      => '*',
	];

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

						return Response::json( $data, 200, $this->headers);
					}
				}
				$data['error'] = $this->error_messages['not_found'];
				return Response::json($data, 200, $this->headers);
			}
			else
			{
				$data['error'] = $this->error_messages['not_found'];
				return Response::json($data, 200, $this->headers);
			}
		}
		catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			$data['error'] = $this->error_messages['not_found'];
			return Response::json($data, 200, $this->headers);
		}
	}

	public function newUserId()
	{
		$test_subject = new TestSubject;

		$ts_names = TestSubjectNames::all();
		$test_subject->name_text = $ts_names[rand(0, count($ts_names)-1)]->name;

		$testsubjects = TestSubject::all();
		$testsubjects = $testsubjects->filter(function($ts) use ($test_subject)
		{
			if($ts->name_text == $test_subject->name_text)
			{
				return $ts;
			}

		});

		$test_subject->name_counter = count($testsubjects) > 0 ? $testsubjects->max('name_counter') + 1 : 1;

		$test_subject->save();

		$data = [];
		$test_subject_data = [];
		$test_subject_data['id'] = $test_subject->id;
		$test_subject_data['name'] = $test_subject->getSubjectName();

		$data['testsubject'] = $test_subject_data;

		return Response::json($data, 200, $this->headers);
	}

	public function getStudyVersion($id)
	{
		try
		{
			$study = Study::findOrFail($id);
			if ( Input::has('password') && Input::get('password') == $study->studypassword)
			{
				$studyversion = [];
				$studyversion['id']			= $study->id;
				$studyversion['version']	= intval($study->version);
				$data['study']				= $studyversion;
				return Response::json($data,200, $this->headers);
			}
			else
			{
				$data['error'] = $this->error_messages['unauthorized'];
				return Response::json($data, 200, $this->headers);
			}
		}
		catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			$data['error'] = $this->error_messages['not_found'];
			return Response::json($data, 200, $this->headers);
		}
	}

	public function getStudy($id)
	{
		try
		{
			$study = Study::findOrFail($id);
			if ( Input::has('password') && Input::get('password') == $study->studypassword)
			{
				return Response::json([
					'study' => $this->studyTransformer->transform($study)
				],200, $this->headers);
			}
			else
			{
				$data['error'] = $this->error_messages['unauthorized'];
				return Response::json($data, 200, $this->headers);
			}
		}
		catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			$data['error'] = $this->error_messages['not_found'];
			return Response::json($data, 200, $this->headers);
		}
	}

	public function postStudyData($id)
	{
		try
		{
			$study = Study::findOrFail($id);

			//TODO: handle input

			if ( Input::has('password') && Input::get('password') == $study->studypassword)
			{
				return Response::json(Input::all(), 200, $this->headers);

			}
			else
			{
				$data['error'] = $this->error_messages['unauthorized'];
				return Response::json(['data' => $data], 200, $this->headers);
			}
		}
		catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			$data['error'] = $this->error_messages['not_found'];
			return Response::json($data, 200, $this->headers);
		}
	}


}