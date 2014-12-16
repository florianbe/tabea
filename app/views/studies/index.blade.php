@extends('layouts.template')

@section('title', trans('pagestrings.studies_index_header'))

@section('header', trans('pagestrings.studies_index_header'))

@section('sidebar')
    @include('studies.sidebars.overview')
@stop
@section('content') 


    @if( (count($studies) > 0) )
    <table id ="studies" class="table table-striped ">
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
          <td><a href="{{ action('StudyController@show', [$study->id]) }}">{{ $study->name}}</a></td>
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

@section('javascript')
    <script type="text/javascript">
          $(document).ready(function() {
                  $('#studies').dataTable( {
                      "language": {
                          "url": "{{ Config::get('app.datatableslocale') }}"
                      }
                  } );
              } );

     </script>
@stop


