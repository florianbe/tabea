@extends('layouts.template')

@section('title', trans('pagestrings.studyrequests_new_header', ['study_name' => $study->name]))

@section('header', trans('pagestrings.studyrequests_new_header', ['study_name' => $study->name]))

@section('sidebar')
       @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study)])
@stop
@section('content')

    {{ Form::open(['route' => ['requests.store', "studyId" => $study->id]]) }}
        {{ Bootstrap::textarea('comment', trans('pagestrings.studyrequests_new_comment') ) }}


          <div class="checkbox">
            <label>
              {{ Form::checkbox('as_contrib', 42, false) }} {{ trans('pagestrings.studyrequests_new_as_contrib') }}
            </label>
          </div>

        {{ Bootstrap::submit(trans('pagestrings.studyrequests_new_create')) }}

    {{ Form::close() }}
@stop
