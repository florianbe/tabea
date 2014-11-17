@extends('layouts.template')

@section('title', trans('pagestrings.studyrequests_index_header'))

@section('header', trans('pagestrings.studyrequests_index_header'))

@section('sidebar')
    <li>{{ HTML::link('/requests', trans('pagestrings.studyrequests_rmenu_indexlink'))}}</li>

@stop
@section('content') 

    {{ display_alert_message() }}
    @if( (count($userRequests) > 0) )
    <h2>{{ trans('pagestrings.studyrequests_index_myRequests') }}</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th>{{ trans('pagestrings.studies_name') }}</th>
          <th>{{ trans('pagestrings.studies_author') }}</th>
          <th>{{ trans('pagestrings.studies_state') }}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <h3></h3>
        @foreach ($studies as $study)
        <tr>
          <td>{{$study->short_name}}</td>
          <td><a href="{{ action('StudiesController@show', array($study->id)) }}">{{ $study->name}}</a></td>
          <td>{{$study->author->fullName}}</td>
          <td>{{$study->studystate->name}}</td>
          <td>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
      <hr/>
    @endif
    @if( count($userResponses > 0))
    <h2>{{ trans('pagestrings.studyrequests_index_myResponse_needed') }}</h2>
    @endif
    @if(count($userResponses < 1) && count($userRequests) < 1)
    <h2>{{ trans('pagestrings.studyrequests_index_no_requests') }}</h2>
    @endif

@stop

