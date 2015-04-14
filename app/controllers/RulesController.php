<?php

use Tabea\Forms\RuleForm;

class RulesController extends \BaseController {

	protected $ruleForm;

	public function __construct(RuleForm $ruleForm)
	{
		$this->ruleForm = $ruleForm;

		$this->beforeFilter('auth');
		$this->beforeFilter('has_study_access');
		$this->beforeFilter('is_study_contributor_or_admin', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 * GET /questionrules
	 *
	 * @return Response
	 */
	public function index($studies, $substudies, $questiongroups)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		$questiongroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', "=", $questiongroups)->firstOrFail();

		$dd_data = Rule::getDropDownData($substudy, $questiongroup->sequence_indicator);

		return View::make('rules.index')->with(compact('questiongroup'))->with(compact('select_questiongroup'))->with(compact('dd_data'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /questionrules
	 *
	 * @return Response
	 */
	public function store($studies, $substudies, $questiongroups)
	{
		try
		{
			$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
			$questiongroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', "=", $questiongroups)->firstOrFail();

			$this->ruleForm->validate(Input::all());



			$rule = new Rule;

			$question = Question::where('questiongroup_id', '=', Input::get('questiongroups'))->where('id_in_questiongroup', '=', Input::get('questions'))->firstOrFail();

			$rule->Question()->associate($question);
			$rule->QuestionGroup()->associate($questiongroup);

			$questiongroup->rules->count() <= 0 ? $rule->id_in_questiongroup = 1 : $rule->id_in_questiongroup = ($questiongroup->rules->max('id_in_questiongroup') +1);

			if ($question->questiontype->code == 'BOOLEAN')
			{
				$rule->is_answer_boolean = true;
				$rule->answer_boolean = (Input::get('questions') == '1' ? true : false);
			}
			else
			{
				$optionchoice = $question->optiongroup->optionchoices->filter(function($choice) { return $choice->code == Input::get('answers');})->first();
				$rule->is_answer_boolean = false;
				$rule->OptionChoice()->associate($optionchoice);
			}

			$rule->save();

			return Redirect::route('studies.substudies.questiongroups.rules.index', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, 'questiongroups' => $questiongroup->id_in_substudy])->with('message', trans('pagestrings.rules_create_successmessage'));
		}
		catch (Laracasts\Validation\FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}


	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /questionrules/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($studies, $substudies, $questiongroups, $questionrules)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		$questiongroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', "=", $questiongroups)->firstOrFail();
		$rule = Rule::where('questiongroup_id', '=', $questiongroup->id)->where('id_in_questiongroup', "=", $questionrules)->firstOrFail();

		$dd_data = Rule::getDropDownData($substudy, $questiongroup->sequence_indicator);


		//return $rule->question;

		return View::make('rules.edit')->with(compact('questiongroup'))->with(compact('select_questiongroup'))->with(compact('dd_data'))->with(compact('rule'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /questionrules/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($studies, $substudies, $questiongroups, $questionrules)
	{
		try
		{
			$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
			$questiongroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', "=", $questiongroups)->firstOrFail();

			$rule = Rule::where('questiongroup_id', '=', $questiongroup->id)->where('id_in_questiongroup', '=', $questionrules)->firstOrFail();

			$this->ruleForm->validate(Input::all());

			$question = Question::where('questiongroup_id', '=', Input::get('questiongroups'))->where('id_in_questiongroup', '=', Input::get('questions'))->firstOrFail();

			$rule->Question()->associate($question);
			$rule->QuestionGroup()->associate($questiongroup);

			if ($question->questiontype->code == 'BOOLEAN')
			{
				$rule->is_answer_boolean = true;
				$rule->answer_boolean = (Input::get('questions') == '1' ? true : false);
			}
			else
			{
				$optionchoice = $question->optiongroup->optionchoices->filter(function($choice) { return $choice->code == Input::get('answers');})->first();
				$rule->is_answer_boolean = false;
				$rule->OptionChoice()->associate($optionchoice);
			}

			$rule->save();

			return Redirect::route('studies.substudies.questiongroups.rules.index', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, 'questiongroups' => $questiongroup->id_in_substudy])->with('message', trans('pagestrings.rules_edit_successmessage'));
		}
		catch (Laracasts\Validation\FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /questionrules/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($studies, $substudies, $questiongroups, $questionrules)
	{
		$substudy = Substudy::where('study_id', '=', $studies)->where('id_in_study', '=', $substudies)->firstOrFail();
		$questiongroup = QuestionGroup::where('substudy_id', '=', $substudy->id)->where('id_in_substudy', "=", $questiongroups)->firstOrFail();
		$rule = Rule::where('questiongroup_id', '=', $questiongroup->id)->where('id_in_questiongroup', "=", $questionrules)->firstOrFail();

		if ($substudy->study->isStudyEditable())
		{
			$rule->delete();

			if (Request::ajax())
			{
				return 1;
			}
			else
			{
				return Redirect::route('studies.substudies.rules.index', ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, 'questiongroup' => $questiongroup->id_in_substudy])->with('message', trans('pagestrings.rules_delete_successmessage'));
			}
		}
	}

}