@extends('layouts.template')

@section('title', trans('pagestrings.question_show_header', ['substudy_name'=>$question->questiongroup->substudy->name]))

@section('header', trans('pagestrings.question_show_header', ['substudy_name'=>$question->questiongroup->substudy->name]))

@section('sidebar')
    @include('questions.sidebars.detail', ['studyId' => $question->questiongroup->substudy->study->id, 'substudyId' => $question->questiongroup->substudy->id, 'questiongroupId' => $question->questiongroup->id_in_substudy, 'questionId' => $question->id_in_questiongroup,  'hasAccess' => Auth::user()->hasAccessToStudy($question->questiongroup->substudy->study), 'canContribute' => (Auth::user()->isAdmin || $question->questiongroup->substudy->study->contributors->contains(Auth::user()))])
@stop
@section('content')
    <h2>{{trans('pagestrings.question_show_questiongroup_header', ['question_group' => $question->questiongroup->name ])}}</h2>
    {{ Form::open(['route' => ['studies.substudies.questiongroups.questions.update', "studies" => $question->questiongroup->substudy->study->id, "substudies" => $question->questiongroup->substudy->id_in_study, "questiongroups" => $question->questiongroup->id_in_substudy, "questions" => $question->id_in_questiongroup], 'method' => 'PUT']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.question_edit_panelheader') }}</h3>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="row"><strong>{{trans('pagestrings.question_shortname') }}</strong></div>
                            <div class="row">{{ $question->shortname }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="row"><strong>{{trans('pagestrings.question_type') }}</strong></div>
                            <div class="row">{{ trans('pagestrings.question_typename_' . $question->questiontype->code) }}</div>
                        </div>
                        <div class="col-md-5">
                            <div class="row"><strong>{{trans('pagestrings.question_answer_required_ol') }}</strong></div>
                            <div class="row">{{ $question->answer_required ? trans('pagestrings.yes') : trans('pagestrings.no') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-group-item">
                <div class="list-group-item-heading"><strong>{{ trans('pagestrings.question_text') }}</strong></div>
                <div class="list-group-item-text">{{ $question->text }}</div>
            </div>
            @if ($question->comment)
            <div class="list-group-item">
                <div class="list-group-item-heading"><strong>{{ trans('pagestrings.question_comment') }}</strong></div>
                <div class="list-group-item-text">{{ $question->comment }}</div>
            </div>
            @endif
            @if ($question->questionrestriction)
            <div class="list-group-item">
                <div class="list-group-item-heading"><h4>{{ trans('pagestrings.question_parameter') }}</h4></div>
                <div class="list-group-item-text">

                    @if ($question->questionrestriction->min_numeric || $question->questionrestriction->max_numeric || $question->questionrestriction->step_numeric)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="row"><strong>{{ trans('pagestrings.question_min_numeric') }}</strong></div>
                                <div class="row">{{ $question->questionrestriction->min_numeric ? $question->questionrestriction->min_numeric : '' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="row"><strong>{{ trans('pagestrings.question_max_numeric') }}</strong></div>
                                <div class="row">{{ $question->questionrestriction->max_numeric ? $question->questionrestriction->max_numeric : '' }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="row"><strong>{{ trans('pagestrings.question_step_numeric') }}</strong></div>
                                <div class="row">{{ $question->questionrestriction->min_numeric ? $question->questionrestriction->step_numeric : '' }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                        @if ($question->optiongroup)
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($question->questiontype->code == 'MULTICHOICE')
                                        <div class="col-md-3">
                                            <div class="row"><strong>{{ trans('pagestrings.question_min_integer') }}</strong></div>
                                            <div class="row">{{ $question->questionrestriction->min_integer ? $question->questionrestriction->min_integer: '' }}</div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row"><strong>{{ trans('pagestrings.question_max_integer') }}</strong></div>
                                            <div class="row">{{ $question->questionrestriction->max_integer ? $question->questionrestriction->max_integer : '' }}</div>
                                        </div>
                                    @endif
                                    @if ($question->questiontype->code == 'SINGLECHOICE')
                                        <div class="col-md-6">
                                            <div class="row"><strong>{{ trans('pagestrings.question_max_integer') }}</strong></div>
                                            <div class="row">{{ $question->optiongroup->code ? trans('pagestrings.question_optiongroup_' . $question->optiongroup->code) : '' }}</div>
                                        </div>
                                    @endif
                                    @if (!($question->optiongroup->is_predefined))
                                        <div class="col-md-6">
                                            <div class="row">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th class="col-md-6">{{ trans('pagestrings.question_selfdef_datavalue') }}</th>
                                                        <th class="col-md-6">{{ trans('pagestrings.question_selfdef_displayvalue') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($question->optiongroup->optionchoices as $choice)
                                                        <tr>
                                                            <td>{{ $choice->value }}</td>
                                                            <td>{{ $choice->description }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                </div>
            </div>
            @endif

        </div>
    </div>
    <div class="list-group-item">
        <div class="list-group-item-text">
            <div class="row">
                <div class="col-md-6 text-left"></div>
                <div class="col-md-6 text-right"><a class="btn btn-primary" href="{{route('studies.substudies.questiongroups.questions.edit', [$question->questiongroup->substudy->study->id,  $question->questiongroup->substudy->id, $question->questiongroup->id_in_substudy, $question->id_in_questiongroup])}}"><i class="icon-plus-sign"></i>  {{ trans('pagestrings.substudies_rmenu_editquestion') }}</a></div>
            </div>
        </div>
    </div>

@stop
