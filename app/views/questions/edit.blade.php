@extends('layouts.template')

@section('title', trans('pagestrings.question_edit_header', ['substudy_name'=>$question->questiongroup->substudy->name]))

@section('header', trans('pagestrings.question_edit_header', ['substudy_name'=>$question->questiongroup->substudy->name]))

@section('sidebar')
    @include('questions.sidebars.detail', ['studyId' => $question->questiongroup->substudy->study->id, 'substudyId' => $question->questiongroup->substudy->id_in_study, 'questiongroupId' => $question->questiongroup->id_in_substudy, 'questionId' => $question->id_in_questiongroup,  'hasAccess' => Auth::user()->hasAccessToStudy($question->questiongroup->substudy->study), 'canContribute' => ($question->questiongroup->substudy->study->hasEditAccess(Auth::user()))])
@stop
@section('content')
    @if($question->questiongroup->substudy->study->isStudyEditable() && ($question->questiongroup->substudy->study->hasEditAccess(Auth::user())))
    <h2>{{trans('pagestrings.question_edit_questiongroup_header', ['question_group' => $question->questiongroup->name ])}}</h2>
    {{ Form::open(['route' => ['studies.substudies.questiongroups.questions.update', "studies" => $question->questiongroup->substudy->study->id, "substudies" => $question->questiongroup->substudy->id_in_study, "questiongroups" => $question->questiongroup->id_in_substudy, "questions" => $question->id_in_questiongroup], 'method' => 'PUT']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.question_edit_panelheader') }}</h3>
        </div>

        <div class="panel-body">
            <!-- Name fields -->
            <div class="row">
                <div class="col-md-6">
                    {{ Bootstrap::text('shortname', trans('pagestrings.question_shortname'), $question->shortname) }}
                    {{ show_errors_for('shortname', $errors) }}
                </div>
                <div class="col-md-3">
                    {{ Bootstrap::select('questiontype', trans('pagestrings.question_type'), $questiondropdown, $question->questiontype->code) }}
                </div>
                <div class="col-md-3">
                    <br/>{{ Bootstrap::checkbox('answer_required', trans('pagestrings.question_answer_required'), 1, $question->answer_required) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ Bootstrap::text('text', trans('pagestrings.question_text'), $question->text) }}
                    {{ show_errors_for('text', $errors) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ Bootstrap::textarea('comment', trans('pagestrings.question_comment'), $question->comment, [], ['rows' => '2'])}}
                    {{ show_errors_for('comment', $errors) }}
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-12 typeoption text boolean moodmap">
                        <p>{{ trans('pagestrings.question_no_config') }}</p>
                    </div>
                </div>
                <div  class="form-group">
                    <div class="col-md-4 typeoption numeric slider">
                        {{ Bootstrap::text('min_numeric', trans('pagestrings.question_min_numeric'), $question->questionrestriction ? $question->questionrestriction->min_numeric : null) }}
                        {{ show_errors_for('min_numeric', $errors) }}
                    </div>
                    <div class="col-md-4 typeoption numeric slider">
                        {{ Bootstrap::text('max_numeric', trans('pagestrings.question_max_numeric'), $question->questionrestriction ? $question->questionrestriction->max_numeric : null) }}
                        {{ show_errors_for('max_numeric', $errors) }}
                    </div>
                    <div class="col-md-4 typeoption slider">
                        {{ Bootstrap::text('step_numeric', trans('pagestrings.question_step_numeric'), $question->questionrestriction ? $question->questionrestriction->step_numeric : null) }}
                        {{ show_errors_for('step_numeric', $errors) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 typeoption singlechoice">
                        {{-- Bootstrap::select('singlechoiceoption', trans('pagestrings.question_type'), $optiondropdown, $question->GetOptionGroupCode()) --}}
                    </div>

                    <div class="col-md-3 typeoption multichoice">
                        {{ Bootstrap::number('min_integer', trans('pagestrings.question_min_integer'), $question->questionrestriction ? $question->questionrestriction->min_integer : null) }}
                        {{ show_errors_for('min_integer', $errors) }}
                    </div>
                    <div class="col-md-3 typeoption multichoice">
                        {{ Bootstrap::number('max_integer', trans('pagestrings.question_max_integer'), $question->questionrestriction ? $question->questionrestriction->max_integer : null) }}
                        {{ show_errors_for('max_integer', $errors) }}
                    </div>

                    <div class="col-md-6 typeoption singlechoice multichoice">
                        {{ Bootstrap::textarea('selfdef_choice', trans('pagestrings.question_selfdef_values'), $question->GetSelfDefValues() ? $question->GetSelfDefValues() : null, [], ['rows' => '5'])}}
                        <p class="bg-primary text-center">{{trans('pagestrings.question_choice_selfdef_info')}}</p>
                        {{ show_errors_for('selfdef_choice', $errors) }}
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="list-group-item">
        <div class="list-group-item-text">
            <div class="row">
                <div class="col-md-6 text-left"><a class="btn btn-primary btn-back" >{{ trans('pagestrings.back') }}</a></div>
                <div class="col-md-6 text-right"> {{ Bootstrap::submit(trans('pagestrings.question_edit_createbutton')) }}</div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    @endif
@stop

@section('javascript')
    <script type="text/javascript">
        var showOptions = function(){
            $(".typeoption").hide();
            var sigsel = "."+ $('#questiontype').val().toLowerCase();

            $(sigsel).show();
        };


        $(document).ready(function(){
            showOptions();
        });

        $('#questiontype').change(function(){
            showOptions();
        });


    </script>
    {{ HTML::script('js/tabea.js') }}
@stop