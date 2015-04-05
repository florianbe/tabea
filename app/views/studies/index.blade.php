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
            <th class="col-md-2">{{ trans('pagestrings.studies_mane_short_short') }}</th>
            <th class="col-md-4">{{ trans('pagestrings.studies_name') }}</th>
            <th class="col-md-3">{{ trans('pagestrings.studies_author') }}</th>
            <th class="col-md-3">{{ trans('pagestrings.studies_state') }}</th>
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
        </tr>
        @endforeach
      </tbody>
    </table>
      <hr/>
    @else
        <h2>{{ trans('pagestrings.studies_index_nostudies') }}</h2>
    @endif
    <div class="list-group-item">
        <div class="list-group-item-text">
            <div class="row">
                <div class="col-md-6 text-left"></div>
                <div class="col-md-6 text-right"><a class="btn btn-primary" href="{{route('studies.create')}}"><i class="icon-plus-sign"></i>  {{ trans('pagestrings.studies_rmenu_createlink') }}</a></div>
            </div>
        </div>
    </div>

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


