<?php

class ApiController extends \BaseController {


	protected $studyTransformer;
	protected $error_messages = [
		'not_found'		=>	[ 'code' => 484, 'message' => 'item not found'],
		'unauthorized'	=>	[ 'code' => 481, 'message' => 'user not authorized'],
		'deprecated'	=>	[ 'code' => 486, 'message' => 'deprecated study version']
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

						return Response::json(['data' => $data], 200);
					}
				}
				$data['error'] = $this->error_messages['not_found'];
				return Response::json(['data' => $data], 200);
			}
			else
			{
				$data['error'] = $this->error_messages['not_found'];
				return Response::json(['data' => $data], 200);
			}
		}
		catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			$data['error'] = $this->error_messages['not_found'];
			return Response::json([$data], 200);
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

		return Response::json(['data' => $data], 200);
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
				$studyversion['version']	= $study->updated_at->toDateTimeString();
				$data['study']				= $studyversion;
				return Response::json(['data'	=>	$data],200);
			}
			else
			{
				$data['error'] = $this->error_messages['unauthorized'];
				return Response::json(['data' => $data], 200);
			}
		}
		catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			$data['error'] = $this->error_messages['not_found'];
			return Response::json([$data], 200);
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
					'data'	=>	$this->studyTransformer->transform($study)
				],200);
			}
			else
			{
				$data['error'] = $this->error_messages['unauthorized'];
				return Response::json(['data' => $data], 200);
			}
		}
		catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			$data['error'] = $this->error_messages['not_found'];
			return Response::json([$data], 200);
		}
	}

	public function postStudy($id)
	{
		try
		{
			$study = Study::findOrFail($id);
			$test_subject = TestSubject::findOrFail(Input::get('subject_id'));

			//TODO: handle input
//
//			if ( Input::has('password') && Input::get('password') == $study->studypassword)
//			{
//				if (Input::has('vers'))
//
//			}
//			else
//			{
//				$data['error'] = $this->error_messages['unauthorized'];
//				return Response::json(['data' => $data], 200);
//			}
		}
		catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			$data['error'] = $this->error_messages['not_found'];
			return Response::json([$data], 200);
		}
	}


}