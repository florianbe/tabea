@extends('layouts.template')

@section('title', (trans('pagestrings.substudies_detail_header', ['study_name' => $substudy->study->short_name, 'substudy_name' => $substudy->name])))

@section('header', (trans('pagestrings.substudies_detail_header', ['study_name' => $substudy->study->name, 'substudy_name' => $substudy->name])))

@section('sidebar')
    @include('studies.sidebars.detail', ['studyId' => $substudy->study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => (Auth::user()->isAdmin || $substudy->study->contributors->contains(Auth::user()))])
    @include('substudies.sidebars.detail', ['studyId' => $substudy->study->id, 'substudyId'=> $substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => (Auth::user()->isAdmin || $substudy->study->contributors->contains(Auth::user()))])
@stop
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.substudies_detail_panelheader', ['study_name' => $substudy->study->name, 'substudy_name' => $substudy->name]) }}</h3>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4"><strong>{{trans('pagestrings.substudies_name_long')}}:</strong></div>
                        <div class="col-md-8">{{ $substudy->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>{{trans('pagestrings.substudies_signal_type')}}:</strong></div>
                        <div class="col-md-8">{{$substudy->getTriggerName()}}</div>
                    </div>
                    @if($substudy->getTrigger() != "EVENT")
                    <div class="row">
                        <div class="col-md-4"><strong>{{$substudy->getTrigger() == 'FIX' ? trans('pagestrings.substudies_signal_timefixtime') : trans('pagestrings.substudies_signal_timeflextime')}}:</strong></div>
                        <div class="col-md-8">{{$substudy->trigger_time_interval}}</div>
                    </div>
                    @endif()
                </div>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading">{{trans('pagestrings.substudies_comment')}}:</h4>
                <div class="list-group-item-text">
                    <p>{{$substudy->comment}}</p>
                </div>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading">{{trans('pagestrings.substudies_description')}}:</h4>
                <div class="list-group-item-text">
                    <p>{{$substudy->description}}</p>
                </div>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading">{{ trans('pagestrings.substudies_surveyperiod_header') }}</h4>
                @if($substudy->surveyperiods->count() == 0)
                    <strong>{{ trans('pagestrings.substudies_surveyperiod_none') }}</strong>
                @else
                    <strong>Bring on the surveyperiods!!!!!One!Eleven</strong>
                @endif
            </div>
        </div>
    </div>
@stop
