@extends('layouts.template')

@section('title', trans('pagestrings.question_editorder_header', ['substudy_name' => $questiongroup->substudy->name, 'questiongroup_name' => $questiongroup->shortname]))

@section('header', trans('pagestrings.question_editorder_header', ['substudy_name' => $questiongroup->substudy->name, 'questiongroup_name' => $questiongroup->name]))

@section('sidebar')
    @include('questiongroups.sidebars.detail', ['studyId' => $questiongroup->substudy->study->id, 'substudyId'=> $questiongroup->substudy->id_in_study, 'questiongroupId' => $questiongroup->id_in_substudy, 'hasAccess' => Auth::user()->hasAccessToStudy($questiongroup->substudy->study), 'canContribute' => ($questiongroup->substudy->study->hasEditAccess(Auth::user())), 'study_editable' => $questiongroup->substudy->study->isStudyEditable()])
@stop

@section('content')
    @if($questiongroup->substudy->study->isStudyEditable() && ($questiongroup->substudy->study->hasEditAccess(Auth::user())) && count($questiongroup->questions) > 0)
    {{ Form::open(['route' => ['studies.substudies.questiongroups.questions.updateorder', "studies" => $questiongroup->substudy->study->id, "substudies" => $questiongroup->substudy->id_in_study, "questiongroups" => $questiongroup->id_in_substudy], 'method' => 'PUT']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.questiongroup_show_panelheader') }}</h3>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-2"><strong>{{trans('pagestrings.questiongroup_name')}}:</strong></div>
                    <div class="col-md-10">{{ $questiongroup->name }}</div>
                </div>
                <div class="row">
                    <div class="col-md-2"><strong>{{trans('pagestrings.questiongroup_shortname')}}:</strong></div>
                    <div class="col-md-4">{{$questiongroup->shortname}}</div>
                    <div class="col-md-3">{{trans('pagestrings.questiongroup_randomquestionorder')}}<strong>:</strong></div>
                    <div class="col-md-3">{{$questiongroup->random_questionorder ?  trans('pagestrings.yes') : trans('pagestrings.no')}}</div>
                </div>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading">{{trans('pagestrings.questiongroup_comment')}}:</h4>
                <div class="list-group-item-text">
                    <p>{{$questiongroup->comment}}</p>
                </div>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading">{{trans('pagestrings.questiongroup_description')}}:</h4>
                <div class="list-group-item-text">
                    <p>{{$questiongroup->description}}</p>
                </div>
            </div>
        </div>
        <div class="list-group-item">
            <h4 class="list-group-item-heading">{{ trans('pagestrings.questiongroup_questionheader')  }}</h4>
            <div class="list-group-item-text">
                <table id ="questiongroups" class="table table-striped ">
                    <thead>
                    <tr>
                        <th class="col-sm-1"></th>
                        <th class="col-sm-3">{{ trans('pagestrings.question_shortname') }}</th>
                        <th class="col-sm-5">{{ trans('pagestrings.question_text') }}</th>
                        <th class="col-sm-2">{{ trans('pagestrings.question_type') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <h3></h3>
                    @foreach ($questiongroup->questions->sortBy('sequence_indicator')  as $question)
                        <tr>
                            <td class="vert-align">{{ Bootstrap::number('questiongroup_order[' . $question->id_in_questiongroup . ']', null, $question->sequence_indicator, null, array('min' => 0, 'step' => 1)) }}</td>
                            <td class="vert-align">{{ HTML::linkRoute('studies.substudies.questiongroups.questions.show', $question->shortname, ['studies' => $questiongroup->substudy->study->id, 'substudies' => $questiongroup->substudy->id_in_study, "questiongroups" => $questiongroup->id_in_substudy, "questions" => $question->id_in_questiongroup]) }}</td>
                            <td class="vert-align">{{ $question->name }}</td>
                            <td class="vert-align">{{ trans('pagestrings.question_typename_' . $question->questiontype->code) }}</td>
                        </tr>
                    @endforeach
                   </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div class="list-group-item-text">
            <div class="row">
                <div class="col-md-6 text-left"><a class="btn btn-primary btn-back" >{{ trans('pagestrings.back') }}</a></div>
                <div class="col-md-6 text-right"> {{ Bootstrap::submit(trans('pagestrings.question_saveorderbutton')) }} </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    @endif
@stop
@section('javascript')
    {{ HTML::script('js/tabea.js') }}
@stop