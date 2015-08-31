@extends('layouts.template')

@section('title', trans('pagestrings.question_create_header', ['substudy_name'=>$questiongroup->substudy->name]))

@section('header', trans('pagestrings.question_create_header', ['substudy_name'=>$questiongroup->substudy->name]))

@section('sidebar')
    @include('questiongroups.sidebars.detail', ['studyId' => $questiongroup->substudy->study->id, 'substudyId' => $questiongroup->substudy->id_in_study, 'questiongroupId' => $questiongroup->id_in_substudy,  'hasAccess' => Auth::user()->hasAccessToStudy($questiongroup->substudy->study), 'canContribute' => ($questiongroup->substudy->study->hasEditAccess(Auth::user()))])
@stop
@section('content')
    @if($questiongroup->substudy->study->isStudyEditable() && ($questiongroup->substudy->study->hasEditAccess(Auth::user())))
    <h2>{{trans('pagestrings.question_create_questiongroup_header', ['question_group' => $questiongroup->name ])}}</h2>
    {{ Form::open(['route' => ['studies.substudies.questiongroups.questions.store', "studies" => $questiongroup->substudy->study->id, "substudies" => $questiongroup->substudy->id_in_study, "questiongroups" => $questiongroup->id_in_substudy], 'method' => 'POST']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.question_create_panelheader') }}</h3>
        </div>

        <div class="panel-body">
            <!-- Name fields -->
            <div class="row">
                <div class="col-md-6">
                    {{ Bootstrap::text('shortname', trans('pagestrings.question_shortname')) }}
                    {{ show_errors_for('shortname', $errors) }}
                </div>
                <div class="col-md-3">
                    {{ Bootstrap::select('questiontype', trans('pagestrings.question_type'), $questiondropdown) }}
                </div>
                <div class="col-md-3">
                    <br/>{{ Bootstrap::checkbox('answer_required', trans('pagestrings.question_answer_required'), 1) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ Bootstrap::text('text', trans('pagestrings.question_text')) }}
                    {{ show_errors_for('text', $errors) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ Bootstrap::textarea('comment', trans('pagestrings.question_comment'), null, [], ['rows' => '2'])}}
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
                        {{ Bootstrap::text('min_numeric', trans('pagestrings.question_min_numeric')) }}
                        {{ show_errors_for('min_numeric', $errors) }}
                    </div>
                    <div class="col-md-4 typeoption numeric slider">
                        {{ Bootstrap::text('max_numeric', trans('pagestrings.question_max_numeric')) }}
                        {{ show_errors_for('max_numeric', $errors) }}
                    </div>
                    <div class="col-md-4 typeoption slider">
                        {{ Bootstrap::text('step_numeric', trans('pagestrings.question_step_numeric')) }}
                        {{ show_errors_for('step_numeric', $errors) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 typeoption singlechoice">
                        {{ Bootstrap::select('singlechoiceoption', trans('pagestrings.question_type'), $optiondropdown) }}
                    </div>
                    <div class="col-md-3 typeoption multichoice">
                        {{ Bootstrap::number('min_integer', trans('pagestrings.question_min_integer')) }}
                        {{ show_errors_for('min_integer', $errors) }}
                    </div>
                    <div class="col-md-3 typeoption multichoice">
                        {{ Bootstrap::number('max_integer', trans('pagestrings.question_max_integer')) }}
                        {{ show_errors_for('max_integer', $errors) }}
                    </div>
                    <div class="col-md-6 typeoption selopt selfsinglechoice multichoice">
                        {{ Bootstrap::textarea('selfdef_choice', trans('pagestrings.question_selfdef_values'), null, [], ['rows' => '5'])}}
                        <p class="bg-primary text-center">{{trans('pagestrings.question_choice_selfdef_info')}}</p>
                        {{ show_errors_for('selfdef_choice', $errors) }}
                    </div>
                    <div class="col-md-6 typeoption selopt likert4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right"><strong>{{trans('pagestrings.question_selfdef_datavalue')}}</strong></div>
                                <div class="col-md-9"><strong>{{trans('pagestrings.question_selfdef_displayvalue')}}</strong></div>
                            </div>
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="row">
                                <div class="col-md-3 text-right">{{$i}}.</div>
                                <div class="col-md-9">{{ Form::text('LIKERT_4[]') }}</div>
                            </div>
                        @endfor
                        </div>
                    </div>
                    <div class="col-md-6 typeoption selopt likert5">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right"><strong>{{trans('pagestrings.question_selfdef_datavalue')}}</strong></div>
                                <div class="col-md-9"><strong>{{trans('pagestrings.question_selfdef_displayvalue')}}</strong></div>
                            </div>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="row">
                                    <div class="col-md-3">{{$i}}.</div>
                                    <div class="col-md-9">{{ Form::text('LIKERT_5[]') }}</div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="col-md-6 typeoption selopt likert6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right"><strong>{{trans('pagestrings.question_selfdef_datavalue')}}</strong></div>
                                <div class="col-md-9"><strong>{{trans('pagestrings.question_selfdef_displayvalue')}}</strong></div>
                            </div>
                            @for ($i = 1; $i <=6; $i++)
                                <div class="row">
                                    <div class="col-md-3">{{$i}}.</div>
                                    <div class="col-md-9">{{ Form::text('LIKERT_6[]') }}</div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="col-md-6 typeoption selopt likert7">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right"><strong>{{trans('pagestrings.question_selfdef_datavalue')}}</strong></div>
                                <div class="col-md-9"><strong>{{trans('pagestrings.question_selfdef_displayvalue')}}</strong></div>
                            </div>
                            @for ($i = 1; $i <= 7; $i++)
                                <div class="row">
                                    <div class="col-md-3">{{$i}}.</div>
                                    <div class="col-md-9">{{ Form::text('LIKERT_7[]') }}</div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="col-md-6 typeoption selopt likert10">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right"><strong>{{trans('pagestrings.question_selfdef_datavalue')}}</strong></div>
                                <div class="col-md-9"><strong>{{trans('pagestrings.question_selfdef_displayvalue')}}</strong></div>
                            </div>
                            @for ($i = 1; $i <= 10; $i++)
                                <div class="row">
                                    <div class="col-md-3">{{$i}}.</div>
                                    <div class="col-md-9">{{ Form::text('LIKERT_10[]') }}</div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
    <div class="list-group-item">
        <div class="list-group-item-text">
            <div class="row">
                <div class="col-md-6 text-left"><a class="btn btn-primary btn-back" >{{ trans('pagestrings.back') }}</a></div>
                <div class="col-md-6 text-right">{{ Bootstrap::submit(trans('pagestrings.question_create_createbutton')) }}</div>
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

        var showSelfsinglechoide = function(){
            if ($('#questiontype').val() == 'SINGLECHOICE'){

                $('.selopt').hide();

                if ($('#singlechoiceoption').val() == 'SELF'){
                    $('.selfsinglechoice').show();
                } else if ($('#singlechoiceoption').val() == 'LIKERT_4'){
                    $('.likert4').show();
                } else if ($('#singlechoiceoption').val() == 'LIKERT_5'){
                    $('.likert5').show();
                } else if ($('#singlechoiceoption').val() == 'LIKERT_6'){
                    $('.likert6').show();
                } else if ($('#singlechoiceoption').val() == 'LIKERT_7'){
                    $('.likert7').show();
                } else if ($('#singlechoiceoption').val() == 'LIKERT_10'){
                    $('.likert10').show();
                }

            } else{
                $('.selopt').hide();
            }
        };

        $(document).ready(function(){
            showSelfsinglechoide();
            showOptions();

        });

        $('#questiontype').change(function(){
            showSelfsinglechoide();
            showOptions();
        });

        $('#singlechoiceoption').change(function(){
            showSelfsinglechoide();
        });
    </script>
    {{ HTML::script('js/tabea.js') }}
@stop