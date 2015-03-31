@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_index_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('header', trans('pagestrings.questiongroup_index_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('sidebar')
    @include('questiongroups.sidebars.overview', ['studyId' => $substudy->study->id, 'substudyId'=> $substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => (Auth::user()->isAdmin || $substudy->study->contributors->contains(Auth::user()))])
    @if( (count($substudy->questiongroups) > 0) )
        <h3>{{ HTML::linkRoute('studies.substudies.questionsgroups.editorder', trans('pagestrings.substudies_rmenu_editquestiongrouporderlink'), [$substudy->study->id, $substudy->id])}}</h3>
    @endif
@stop

@section('content')


    @if( (count($substudy->questiongroups) > 0) )
        <table id ="questiongroups" class="table table-striped ">
            <thead>
            <tr>
                <th class="col-md-1"><a href="{{route('studies.substudies.questionsgroups.editorder',[$substudy->study->id, $substudy->id])}}"><i class="fa fa-pencil fa-lg"></i></a></th>
                <th class="col-md-1"></th>
                <th class="col-md-3">{{ trans('pagestrings.questiongroup_shortname') }}</th>
                <th class="col-md-5">{{ trans('pagestrings.questiongroup_name') }}</th>
                <th class="col-md-2">{{ trans('pagestrings.questiongroup_countquestions') }}</th>
            </tr>
            </thead>
            <tbody>
            <h3></h3>
            @foreach ($substudy->questiongroups->sortBy('sequence_indicator')  as $questiongroup)
                <tr>
                    <td>{{ $questiongroup->sequence_indicator }}</td>
                    <td>{{ Form::model($questiongroup, ['route' => ['studies.substudies.questiongroups.destroy', "studies" => $substudy->study->id, "substudies" => $substudy->id_in_study, "questiongroups" => $questiongroup->id_in_substudy], 'method' => 'DELETE']) }}<button type="submit" class="btn btn-link "><i class="fa fa-times fa-lg" style="color: red"></i></button>{{Form::close()}}</td>
                    <td>{{ HTML::linkRoute('studies.substudies.questiongroups.show', $questiongroup->shortname, ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, "questiongroups" => $questiongroup->id_in_substudy]) }}</td>
                    <td>{{ $questiongroup->name }}</td>
                    <td>{{ $questiongroup->questions->count() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr/>
    @else
        <h2>{{ trans('pagestrings.questiongroup_index_questiongroups') }}</h2>
    @endif
@stop