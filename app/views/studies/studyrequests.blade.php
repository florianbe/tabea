@extends('layouts.template')

@section('title', (trans('pagestrings.studies_showrequests_header', ['study_name' => $study->short_name])))

@section('header', (trans('pagestrings.studies_showrequests_header', ['study_name' => $study->name])))

@section('sidebar')
       @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
@stop
@section('content') 


    @if( (count($studyRequests) > 0) )
    <table id="studies" class="table table-striped">
      <thead>
        <tr>
          <th>{{ trans('pagestrings.studies_showrequests_fullname') }}</th>
          <th>{{ trans('pagestrings.studies_showrequests_email') }}</th>
          <th>{{ trans('pagestrings.studies_showrequests_state') }}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($studyRequests as $sRequest)
        <tr>
          <td>{{ $sRequest->requestingUser->full_name }}</td>
          <td>{{ $sRequest->requestingUser->email }}</td>
          <td>{{ !($sRequest->is_viewed) ? trans('pagestrings.studyrequests_index_open') : trans('pagestrings.studyrequests_index_denied') }}</td>
          <td><a href="{{ route('requests.edit', [$sRequest->id]) }}"><i class="fa fa-pencil"></i> {{ trans('pagestrings.studies_showrequests_edit') }}</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
      <hr/>
    @else
        <h2>{{ trans('pagestrings.studies_showrequests_nostudyrequests') }}</h2>
    @endif
@stop