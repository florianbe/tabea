@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_create_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('header', trans('pagestrings.questiongroup_create_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('sidebar')
    @include('questiongroups.sidebars.overview', ['studyId' => $substudy->study->id, 'substudyId'=> $substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => ($substudy->study->hasEditAccess(Auth::user())), 'study_editable' => $substudy->study->isStudyEditable()])
@stop

@section('content')
    @if($substudy->study->isStudyEditable() && ($substudy->study->hasEditAccess(Auth::user())))
    {{ Form::open(['route' => ['studies.substudies.questiongroups.store', "studies" => $substudy->study->id, "substudies" => $substudy->id_in_study], 'method' => 'POST']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.questiongroup_create_panelheader') }}</h3>
        </div>

        <div class="panel-body">
            <!-- Name fields -->
            <div class="row">
                <div class="col-md-2">
                    {{ Bootstrap::text('shortname', trans('pagestrings.questiongroup_shortname')) }}
                    {{ show_errors_for('shortname', $errors) }}
                </div>
                <div class="col-md-7">
                    {{ Bootstrap::text('name', trans('pagestrings.questiongroup_name_long')) }}
                    {{ show_errors_for('name', $errors) }}
                </div>
                <div class="col-md-3">
                    <br/>
                    {{ Bootstrap::checkbox('random_questionorder', trans('pagestrings.questiongroup_randomquestionorder'), 1, false) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {{ Bootstrap::textarea('comment', trans('pagestrings.substudies_comment'), null, [], ['rows' => '4'])}}
                    {{ show_errors_for('comment', $errors) }}
                </div>
                <div class="col-md-6">
                    {{ Bootstrap::textarea('description', trans('pagestrings.substudies_description'), null, [], ['rows' => '4'])}}
                    {{ show_errors_for('description', $errors) }}
                </div>
            </div>

        </div>
    </div>
    <div class="list-group-item">
        <div class="list-group-item-text">
            <div class="row">
                <div class="col-md-6 text-left"><a class="btn btn-primary btn-back" >{{ trans('pagestrings.back') }}</a></div>
                <div class="col-md-6 text-right">{{ Bootstrap::submit(trans('pagestrings.questiongroup_create_createbutton')) }}</div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    @endif
@stop

@section('javascript')
    {{ HTML::script('js/tabea.js') }}
@stop