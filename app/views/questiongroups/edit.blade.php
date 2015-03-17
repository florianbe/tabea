@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_edit_header', ['study_name'=>$questiongroup->substudy->study->name, 'substudy_name'=>$questiongroup->substudy->name]))

@section('header', trans('pagestrings.questiongroup_edit_header', ['study_name'=>$questiongroup->substudy->study->name, 'substudy_name'=>$questiongroup->substudy->name]))

@section('sidebar')
    @include('questiongroups.sidebars.overview', ['studyId' => $questiongroup->substudy->study->id, 'substudyId'=> $questiongroup->substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($questiongroup->substudy->study), 'canContribute' => (Auth::user()->isAdmin || $questiongroup->substudy->study->contributors->contains(Auth::user()))])
@stop

@section('content')
    {{ Form::open(['route' => ['studies.substudies.questiongroups.update', "studies" => $questiongroup->substudy->study->id, "substudies" => $questiongroup->substudy->id_in_study, "questiongroup" => $questiongroup->id_in_substudy], 'method' => 'PUT']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.questiongroup_edit_panelheader') }}</h3>
        </div>

        <div class="panel-body">
            <!-- Name fields -->
            <div class="row">
                <div class="col-md-3">
                    {{ Bootstrap::text('shortname', trans('pagestrings.questiongroup_shortname'), $questiongroup->shortname) }}
                    {{ show_errors_for('shortname', $errors) }}
                </div>
                <div class="col-md-9">
                    {{ Bootstrap::text('name', trans('pagestrings.questiongroup_name_long'), $questiongroup->name) }}
                    {{ show_errors_for('name', $errors) }}
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

            <div class="row">
                <div class="col-md-12">
                    {{ Bootstrap::submit(trans('pagestrings.questiongroup_edit_createbutton')) }}
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    <h4></h4>

@stop
