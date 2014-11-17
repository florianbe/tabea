@extends('layouts.template')

@section('title', trans('pagestrings.studies_index_header'))

@section('header', trans('pagestrings.studies_index_header'))

@section('sidebar')
    <li>{{ HTML::link('/studies/create', trans('pagestrings.studies_rmenu_createlink'))}}</li>
    <li>{{ HTML::link('/studies', trans('pagestrings.studies_rmenu_indexlink'))}}</li>
    <li>{{ HTML::link('/studies/my', trans('pagestrings.studies_rmenu_mystudieslink'))}}</li>
@stop
@section('content') 
    
    {{ display_alert_message() }}
    @if( (count($studies) > 0) )
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
    @else
        <h2>{{ trans('pagestrings.studies_index_nostudies') }}</h2>
    @endif
@stop

