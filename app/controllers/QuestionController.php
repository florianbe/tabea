<?php

use Tabea\Forms\QuestionForm;


class QuestionController extends \BaseController {

	protected $questionForm;

	function __construct(QuestionForm $questionForm)
	{
		$this->questionForm = $questionForm;

		$this->beforeFilter('auth');
		$this->beforeFilter('has_study_access');
		$this->beforeFilter('is_study_contributor_or_admin', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
	}

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
	public function store($studies, $substudies, $questiongroups)
	{
		try
		{
			$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
			$questiongroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', "=", $questiongroups)->firstOrFail();

			// Invoke custom validation rules based on db settings & uniqueness of shortname in questiongroup
			// Get mandatory restrictions according to questiontype
			$questionType = QuestionType::where('code', '=', strtoupper(Input::get('questiontype')))->firstOrFail();
			$optiongroup_preset = null;

			$this->questionForm->setRules('shortname', $this->questionForm->getRules('shortname') . 'NULL,id,questiongroup_id,' .  $questiongroup->id);

			// Add 'required' as first validation criteria based on db-settings
			if (strlen($questionType->mandatory_restrictions) > 0)
			{
				foreach (explode(';',$questionType->mandatory_restrictions) as $restriction)
				{
					$this->questionForm->setRules($restriction, 'required|' . $this->questionForm->getRules($restriction));
				}
			}

			// Set dummy-max for singlechoice self-validation
			if (strtoupper(Input::get('singlechoiceoption')) == 'SELF' && strtoupper(Input::get('questiontype')) == 'SINGLECHOICE')
			{
				Input::merge(array('max_integer' => '1'));
				$this->questionForm->setRules('selfdef_choice', 'required|' . $this->questionForm->getRules('selfdef_choice'));
			}
			elseif(strtoupper(Input::get('questiontype')) == 'SINGLECHOICE')
			{
				$optiongroup_preset = OptionGroup::where('code', '=', strtoupper(Input::get('singlechoiceoption')))->firstOrFail();
			}


			$this->questionForm->validate(Input::all());

			$question = new Question;

			$question->shortname = Input::get('shortname');
			$question->text = Input::get('text');
			$question->comment = Input::get('comment');
			$question->answer_required = Input::has('answer_required');
			$question->QuestionType()->associate($questionType);

			if ((strtoupper(Input::get('singlechoiceoption')) == 'SELF' && strtoupper(Input::get('questiontype')) == 'SINGLECHOICE') || strtoupper(Input::get('questiontype')) == 'MULTICHOICE')
			{

				$optionGroup = new OptionGroup;
				$optionGroup->code = $substudy->study->short_name . '_' . $question->shortname;
				$optionGroup->is_predefined = false;

				$optionGroup->save();

				$countOptions = 0;

				foreach (preg_split( '/\r\n|\r|\n/', Input::get('selfdef_choice')) as $option_input)
				{
					if (strlen($option_input) > 0)
					{
						$countOptions = $countOptions + 1;
						$optionChoice = new OptionChoice;
						$optionChoice->code = $question->shortname . '_' . (string)$countOptions;
						$optionChoice->description = explode(';', $option_input)[1];
						$optionChoice->value = explode(';', $option_input)[0];
						$optionChoice->OptionGroup()->associate($optionGroup);
						$optionChoice->save();
					}
				}


			}

			$questiongroup->questions->count() <= 0 ? $question->id_in_questiongroup = 1 : $question->id_in_questiongroup = ($questiongroup->questions->max('id_in_questiongroup') +1);
			$question->sequence_indicator = $questiongroup->questions->max('sequence_indicator') +1;

			$question->QuestionGroup()->associate($questiongroup);
			$question->QuestionType()->associate($questionType);

			if ((strtoupper(Input::get('singlechoiceoption')) == 'SELF' && strtoupper(Input::get('questiontype')) == 'SINGLECHOICE') || strtoupper(Input::get('questiontype')) == 'MULTICHOICE')
			{
				$question->OptionGroup()->associate($optionGroup);
			}
			if (strtoupper(Input::get('questiontype')) == 'SINGLECHOICE')
			{
				$question->OptionGroup()->associate($optiongroup_preset);
			}

			$question->save();


			if (strlen($questionType->mandatory_restrictions) > 0)
			{
				$questionRestriction = new QuestionRestriction;
								//Set mandatory restrictions
				foreach (explode(';', $questionType->mandatory_restrictions) as $restriction)
				{

					if (!($restriction == 'selfdef_choice')) {
						$questionRestriction[$restriction] = Input::get($restriction);
					}
				}

				$questionRestriction->Question()->associate($question);
				$questionRestriction->save();
			}

			return Redirect::route('studies.substudies.questiongroups.show', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, 'questiongroup' => $questiongroup->id_in_substudy])->with('message', trans('pagestrings.questions_create_successmessage'));
		}
		catch (Laracasts\Validation\FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}


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