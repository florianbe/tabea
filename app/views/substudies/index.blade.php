@extends('layouts.template')

@section('title', trans('pagestrings.substudies_index_header', ['study_name' => $study->short_name]))

@section('header', trans('pagestrings.substudies_index_header', ['study_name' => $study->name])))

@section('sidebar')
    @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
    @include('substudies.sidebars.overview', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
@stop
@section('content')


    @if( (count($study->substudies) > 0) )
        {{Form::open()}}
        <table id ="substudies" class="table table-striped ">
            <thead>
            <tr>
                <th class="col-md-8">{{ trans('pagestrings.substudies_name') }}</th>
                <th class="col-md-3">{{ trans('pagestrings.substudies_signal_type') }}</th>
                <th class="col-md-1"></th>
            </tr>
            </thead>
            <tbody>
            <h3></h3>
            @foreach ($study->substudies as $substudy)
                <tr>
                    <td>{{ HTML::linkRoute('studies.substudies.show', $substudy->name, ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study]) }}</td>
                    <td>{{ $substudy->getTriggerName() }}</td>
                    <td>{{ Form::model($substudy, ['route' => ['studies.substudies.destroy', "studies" => $substudy->study->id, "substudies" => $substudy->id_in_study], 'method' => 'DELETE']) }}<button type="submit" class="btn btn-link "><i class="fa fa-times fa-lg" style="color: red"></i></button>
                        {{Form::close()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr/>
    @else
        <h2>{{ trans('pagestrings.substudies_index_nosubstudies') }}</h2>
    @endif
@stop

