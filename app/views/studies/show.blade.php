@extends('layouts.template')

@section('title', trans('pagestrings.studies_index_header'))

@section('header', trans('pagestrings.studies_index_header'))

@section('sidebar')
    @if(Auth::user()->hasAccessToStudy($study))

    @else

    @endif
@stop
@section('content') 
    
    {{ display_alert_message() }}
    <h1>HEllo my friend</h1>
@stop

