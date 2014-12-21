@extends('layouts.template')

@section('title', trans('pagestrings.substudies_index_header', ['study_name' => $study->short_name]))

@section('header', trans('pagestrings.substudies_index_header', ['study_name' => $study->name])))

@section('sidebar')
    @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
    @include('substudies.sidebars.overview', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
@stop
@section('content')


    @if( (count($study->substudies) > 0) )
        <table id ="substudies" class="table table-striped ">
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
            @foreach ($study->substudies as $substudy)
                <tr>
                    <td>Bla</td>
                    <td>Bla</td>
                    <td>Blub</td>
                    <td>DieDub</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr/>
    @else
        <h2>{{ trans('pagestrings.substudies_index_nosubstudies') }}</h2>
    @endif
@stop


