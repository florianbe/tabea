@extends('layouts.template')

@section('title', trans('pagestrings.studies_index_header'))

@section('header', trans('pagestrings.studies_index_header'))

@section('sidebar')
    @if(Auth::user()->hasAccessToStudy($study))

    @else
        <li>{{ HTML::linkRoute('request.new', trans('pagestrings.study_show_request_access'), ["studyId" => $study->id]) }}</li>
    @endif
@stop
@section('content') 
    
    {{ display_alert_message() }}
    <h1>HEllo my friend</h1>
@stop

