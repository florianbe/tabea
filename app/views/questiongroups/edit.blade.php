@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_edit_header', ['study_name'=>$questiongroup->substudy->study->name, 'substudy_name'=>$questiongroup->substudy->name]))

@section('header', trans('pagestrings.questiongroup_edit_header', ['study_name'=>$questiongroup->substudy->study->name, 'substudy_name'=>$questiongroup->substudy->name]))

@section('sidebar')
    @include('questiongroups.sidebars.detail', ['studyId' => $questiongroup->substudy->study->id, 'substudyId'=> $questiongroup->substudy->id_in_study, 'questiongroupId' => $questiongroup->id_in_substudy, 'hasAccess' => Auth::user()->hasAccessToStudy($questiongroup->substudy->study), 'canContribute' => ($questiongroup->substudy->study->hasEditAccess(Auth::user()))])
@stop

@section('content')
    @if($questiongroup->substudy->study->isStudyEditable() && ($questiongroup->substudy->study->hasEditAccess(Auth::user())))
    {{ Form::open(['route' => ['studies.substudies.questiongroups.update', "studies" => $questiongroup->substudy->study->id, "substudies" => $questiongroup->substudy->id_in_study, "questiongroup" => $questiongroup->id_in_substudy], 'method' => 'PUT']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.questiongroup_edit_panelheader') }}</h3>
        </div>

        <div class="panel-body">
            <!-- Name fields -->
            <div class="row">
                <div class="col-md-2">
                    {{ Bootstrap::text('shortname', trans('pagestrings.questiongroup_shortname'), $questiongroup->shortname) }}
                    {{ show_errors_for('shortname', $errors) }}
                </div>
                <div class="col-md-7">
                    {{ Bootstrap::text('name', trans('pagestrings.questiongroup_name_long'), $questiongroup->name) }}
                    {{ show_errors_for('name', $errors) }}
                </div>
                <div class="col-md-3">
                    <br/>
                    {{ Bootstrap::checkbox('random_questionorder', trans('pagestrings.questiongroup_randomquestionorder'), 1, $questiongroup->random_questionorder) }}
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    {{ Bootstrap::textarea('comment', trans('pagestrings.substudies_comment'), $questiongroup->comment, [], ['rows' => '4'])}}
                    {{ show_errors_for('comment', $errors) }}
                </div>
                <div class="col-md-6">
                    {{ Bootstrap::textarea('description', trans('pagestrings.substudies_description'), $questiongroup->description, [], ['rows' => '4'])}}
                    {{ show_errors_for('description', $errors) }}
                </div>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div class="list-group-item-text">
            <div class="row">
                <div class="col-md-6 text-left"><a class="btn btn-primary btn-back" >{{ trans('pagestrings.back') }}</a></div>
                <div class="col-md-6 text-right"> {{ Bootstrap::submit(trans('pagestrings.questiongroup_edit_createbutton')) }}</div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    @endif
@stop

@section('javascript')
    {{ HTML::script('js/tabea.js') }}
@stop