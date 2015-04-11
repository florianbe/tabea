@extends('layouts.template')

@section('title', trans('pagestrings.rules_index_header', ['study_name'=>$questiongroup->substudy->study->name, 'substudy_name'=>$questiongroup->substudy->name]))

@section('header', trans('pagestrings.rules_index_header', ['study_name'=>$questiongroup->substudy->study->name, 'substudy_name'=>$questiongroup->substudy->name]))

@section('sidebar')
    @include('questiongroups.sidebars.detail', ['studyId' => $questiongroup->substudy->study->id, 'substudyId'=> $questiongroup->substudy->id_in_study, 'questiongroupId' => $questiongroup->id_in_substudy, 'hasAccess' => Auth::user()->hasAccessToStudy($questiongroup->substudy->study), 'canContribute' => (Auth::user()->isAdmin || $questiongroup->substudy->study->contributors->contains(Auth::user()))])
@stop

@section('content')
    @if( (count($questiongroup->rules) > 0) )
        <p>{{trans('pagestrings.rules_infotext')}}</p>
        <table id ="rules" class="table table-striped ">
            <thead>
            <tr>
                <th class="col-md-2"></th>
                <th class="col-md-2">{{ trans('pagestrings.rules_question_shortname') }}</th>
                <th class="col-md-5">{{ trans('pagestrings.rules_question_name') }}</th>
                <th class="col-md-2">{{ trans('pagestrings.rules_answer') }}</th>
                <th class="col-md-2">{{ trans('pagestrings.rules_questiongroup') }}</th>
            </tr>
            </thead>
            <tbody>
            <h3></h3>
            @foreach ($questiongroup->rules as $rule)
                <tr id="{{ 'tr_' . $rule->id_in_questiongroup }}">
                    <td class="vert-align">
                        <div class="row">
                            <div class="col-sm-4"><a href="{{route('studies.substudies.questiongroups.rules.edit',[$rule->questiongroup->substudy->study->id, $rule->questiongroup->substudy->id_in_study, $rule->questiongroup->id_in_substudy, $rule->id_in_questiongroup])}}"><i class="fa fa-pencil"></i></a></div>
                            <div class="col-sm-4"><a href="" class="btn-delete" data-token="{{ csrf_token() }}" data-item_id="{{ $rule->id_in_questiongroup }}"><i class="fa fa-trash-o"></i></a></div>
                        </div>
                    </td>
                    <td class="vert-align">{{ $rule->question->shortname }}</td>
                    <td class="vert-align">{{ $rule->question->text}}</td>
                    <td class="vert-align">{{ $rule->getAnswerText() }}</td>
                    <td class="vert-align">{{ $rule->question->questiongroup->shortname }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr/>
    @else
        <h2>{{ trans('pagestrings.rules_no_rules_found') }}</h2>
    @endif
        <hr/>
    @if($questiongroup->substudy->study->isStudyEditable())
        {{ Form::open(['route' => ['studies.substudies.questiongroups.rules.store', "studies" => $questiongroup->substudy->study->id, "substudies" => $questiongroup->substudy->id_in_study, "questiongroup" => $questiongroup->id_in_substudy], 'method' => 'POST']) }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('pagestrings.rules_new_panelheader') }}</h3>
            </div>
            <div class="panel-body">
                <!-- Name fields -->
                <div class="row">
                    <div class="col-md-4">
                        {{ Bootstrap::select('questiongroups', trans('pagestrings.rules_questiongroup')) }}
                        {{ show_errors_for('questiongroups', $errors) }}
                    </div>
                    <div class="col-md-5">
                        {{ Bootstrap::select('questions', trans('pagestrings.rules_question')) }}
                        {{ show_errors_for('questions', $errors) }}
                    </div>
                    <div class="col-md-3">
                        {{ Bootstrap::select('answers', trans('pagestrings.rules_answer')) }}
                        {{ show_errors_for('answers', $errors) }}
                    </div>
                </div>
            </div>
            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-6 text-left"></div>
                    <div class="col-md-6 text-right"> {{ Bootstrap::submit(trans('pagestrings.rules_new_createbutton')) }}</div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    @endif
@stop

@section('javascript')
    {{ HTML::script('js/tabea.js') }}
    <script type="text/javascript">
        @if($questiongroup->substudy->study->isStudyEditable())
        var m_answer = '{{ trans('pagestrings.rules_delete_confirm') }}';
        var m_success = '{{ trans('pagestrings.rules_delete_successmessage_a') }}';
        var route = '{{route('studies.substudies.questiongroups.rules.destroy',[$questiongroup->substudy->study->id, $questiongroup->substudy->id_in_study, $questiongroup->id_in_substudy, '__id__'])}}';
        var m_error = '{{ trans('pagestrings.errormessage_reload') }}';

        var dd_data = jQuery.parseJSON('{{json_encode($dd_data)}}');

        $( document ).ready(function() {
            rules_SetQuestionGroupField();
            rules_setQuestionField();
            rules_setAnswerField();
        });

        $('#questiongroups').change(function () {
            rules_setQuestionField();
            rules_setAnswerField();
        });

        $('#questions').change(function () {
            rules_setAnswerField();
        });

        @endif
    </script>
@stop


