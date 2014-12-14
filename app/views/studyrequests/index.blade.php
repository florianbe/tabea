@extends('layouts.template')

@section('title', trans('pagestrings.studyrequests_index_header'))

@section('header', trans('pagestrings.studyrequests_index_header'))

@section('sidebar')
<ul class="nav nav-sidebar">
    <li class="{{set_class('requests.index')}}">{{ HTML::linkRoute('requests.index', trans('pagestrings.studyrequests_rmenu_indexlink'))}}</li>
</ul>
@stop
@section('content') 

    @if( (count($my_StudyRequests) > 0) )
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="col-md-1"></th>
          <th class="col-md-5">{{ trans('pagestrings.studies_name') }}</th>
          <th class="col-md-3">{{ trans('pagestrings.studies_author') }}</th>
          <th class="col-md-2">{{ trans('pagestrings.studies_state') }}</th>
          <th class="col-md-1"></th>
        </tr>
      </thead>
      <tbody>
        <h3></h3>
        @foreach ($my_StudyRequests as $study_request)
        <tr>
          <td>{{$study_request->study->short_name}}</td>
          <td><a href="{{ action('StudyController@show', array($study_request->study->id)) }}">{{ $study_request->study->name}}</a></td>
          <td>{{$study_request->study->author->fullName}}</td>
          <td>{{!($study_request->is_viewed) ? trans('pagestrings.studyrequests_index_open') : trans('pagestrings.studyrequests_index_denied')}}</td>
          <td>
            {{ Form::model($study_request, ['route' => ['requests.destroy', $study_request->id], 'method' => 'DELETE']) }}<button type="submit" class="btn btn-link "><i class="fa fa-times fa-lg" style="color: red"></i></button>
{{Form::close()}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
      <hr/>
    @endif
    @if(count($my_StudyRequests) < 1)
    <h2>{{ trans('pagestrings.studyrequests_index_no_requests') }}</h2>
    @endif

@stop

