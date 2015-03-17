@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_show_header', ['substudy_name' => $questiongroup->substudy->name, 'questiongroup_name' => $questiongroup->shortname]))

@section('header', trans('pagestrings.questiongroup_show_header', ['substudy_name' => $questiongroup->substudy->name, 'questiongroup_name' => $questiongroup->name]))

@section('sidebar')
    @include('questiongroups.sidebars.detail', ['studyId' => $questiongroup->substudy->study->id, 'substudyId'=> $questiongroup->substudy->id_in_study, 'questiongroupId' => $questiongroup->id_in_substudy, 'hasAccess' => Auth::user()->hasAccessToStudy($questiongroup->substudy->study), 'canContribute' => (Auth::user()->isAdmin || $questiongroup->substudy->study->contributors->contains(Auth::user()))])
@stop

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.questiongroup_show_panelheader') }}</h3>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4"><strong>{{trans('pagestrings.questiongroup_name')}}:</strong></div>
                        <div class="col-md-8">{{ $questiongroup->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>{{trans('pagestrings.questiongroup_shortname')}}:</strong></div>
                        <div class="col-md-8">{{$questiongroup->shortname}}</div>
                    </div>
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
    </div>


@stop
