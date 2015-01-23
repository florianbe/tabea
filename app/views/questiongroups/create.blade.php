@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_create_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('header', trans('pagestrings.questiongroup_create_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('sidebar')
    @include('questiongroups.sidebars.overview', ['studyId' => $substudy->study->id, 'substudyId'=> $substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => (Auth::user()->isAdmin || $substudy->study->contributors->contains(Auth::user()))])
@stop

@section('content')
    {{ Form::open(['route' => ['studies.substudies.questiongroup.store', "studies" => $substudy->study->id, "substudies" => $substudy->id_in_study], 'method' => 'POST']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.questiongroup_create_panelheader') }}</h3>
        </div>

        <div class="panel-body">
            <!-- Name fields -->
            <div class="row">
                <div class="col-md-3">
                    {{ Bootstrap::text('shortname', trans('pagestrings.questiongroup_shortname')) }}
                    {{ show_errors_for('shortname', $errors) }}
                </div>
                <div class="col-md-9">
                    {{ Bootstrap::text('name', trans('pagestrings.questiongroup_name_long')) }}
                    {{ show_errors_for('name', $errors) }}
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

            <div class="row">
                <div class="col-md-12">
                    {{ Bootstrap::submit(trans('pagestrings.questiongroup_create_createbutton')) }}
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    <h4></h4>

@stop
