@extends('layouts.template')

@section('title', (trans('pagestrings.studies_results_header', ['study_name' => $study->short_name])))

@section('header', (trans('pagestrings.studies_results_header', ['study_name' => $study->name])))

@section('sidebar')
    @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => $study->hasEditAccess(Auth::user())])
@stop
@section('content')
    <h2>{{trans('pagestrings.studies_results_no_results')}}</h2>
@stop
