@extends('layouts.template')

@section('title', trans('pagestrings.studyrequests_edit_header', ['study_name' => $studyRequest->study->short_name]))

@section('header', trans('pagestrings.studyrequests_edit_header', ['study_name' => $studyRequest->study->name]))

@section('sidebar')
       @include('studies.sidebars.detail', ['studyId' => $studyRequest->study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($studyRequest->study)])
@stop
@section('content')
    {{ Form::open(['route' => ['requests.update',   'requests' => $studyRequest->id], 'method' => 'PUT']) }}
        <div class="row">
            <div class="col-md-4"><strong>{{trans('pagestrings.studies_showrequests_fullname')}}:</strong></div>
            <div class="col-md-8"><p>{{ $studyRequest->requestingUser->full_name }}</p></div>
        </div>
        <div class="row">
            <div class="col-md-4"><strong>{{trans('pagestrings.studyrequests_new_comment')}}:</strong></div>
            <div class="col-md-8"><p>{{ $studyRequest->comment }}</p></div>
        </div>
        <div class="row">
            <div class="col-md-4"><strong>{{trans('pagestrings.studyrequests_new_as_contrib')}}:</strong></div>
            <div class="col-md-8"><p>{{ $studyRequest->as_contributor ? trans('pagestrings.yes') : trans('pagestrings.no') }}</p></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"> {{ Bootstrap::select('request_state', null, [
            '1' => trans('pagestrings.studyrequests_edit_select_please'),
            '2' => trans('pagestrings.studyrequests_edit_select_deny'),
            '3' => trans('pagestrings.studyrequests_edit_select_read'),
            '4' => trans('pagestrings.studyrequests_edit_select_contribute'),
            ], 1) }} </div>
            <div class="col-md-4">{{ Bootstrap::submit(trans('pagestrings.studyrequests_edit_set')) }}</div>
        </div>
    {{ Form::close() }}
@stop
