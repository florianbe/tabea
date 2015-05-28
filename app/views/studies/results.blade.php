@extends('layouts.template')

@section('title', (trans('pagestrings.studies_results_header', ['study_name' => $study->short_name])))

@section('header', (trans('pagestrings.studies_results_header', ['study_name' => $study->name])))

@section('sidebar')
    @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => $study->hasEditAccess(Auth::user())])
@stop
@section('content')
    @if( (count($study->substudies) > 0) )
    <table id ="substudies" class="table table-striped ">
        <thead>
        <tr>
            <th class="col-md-1"></th>
            <th class="col-md-5">{{ trans('pagestrings.substudies_name') }}</th>
            <th class="col-md-2">{{ trans('pagestrings.studies_results_subjects') }}</th>
            <th class="col-md-2">{{ trans('pagestrings.studies_results_datasets') }}</th>
            <th class="col-md-2">{{ trans('pagestrings.studies_results_get') }}</th>
        </tr>
        </thead>
        <tbody>
        <h3></h3>
        @foreach ($study->substudies->sortBy('id_in_study') as $su_index =>  $substudy)
            <tr id="{{ 'tr_' . $substudy->id_in_study }}">
                <td class="vert-align">{{ $su_index + 1 }}</td>
                <td class="vert-align">{{ $substudy->name}}</td>
                <td class="vert-align">{{ $substudy->getSumSubjects()}}</td>
                <td class="vert-align">{{ $substudy->getSumDatapoints()}}</td>
                <td class="vert-align"><a href="{{route('studies.substudies.answers',['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study]) }}"><i class="fa fa-file-text-o"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <h2>{{trans('pagestrings.studies_results_no_results')}}</h2>
    @endif
@stop
