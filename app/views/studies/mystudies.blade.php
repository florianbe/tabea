@extends('layouts.template')

@section('title', trans('pagestrings.studies_my_header'))

@section('header', trans('pagestrings.studies_my_header'))

@section('sidebar')
    @include('studies.sidebars.overview')
@stop
@section('content') 


    @if( (count($studies_my) > 0) )
    <table id="studies" class="table table-striped">
      <thead>
        <tr>
          <th>{{ trans('pagestrings.studies_role') }}</th>
          <th></th>
          <th>{{ trans('pagestrings.studies_name') }}</th>
          <th>{{ trans('pagestrings.studies_state') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($studies_my as $state => $studies)
        @foreach ($studies as $study)
        <tr>
          <td>{{ $state }}</td>
          <td>{{$study->short_name}}</td>
          <td><a href="{{ action('StudyController@show', array($study->id)) }}">{{ $study->name}}</a></td>
          <td>{{$study->studystate->name}}</td>
        </tr>
        @endforeach
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
