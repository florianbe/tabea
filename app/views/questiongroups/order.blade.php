@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_editorder_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('header', trans('pagestrings.questiongroup_editorder_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('sidebar')
    @include('questiongroups.sidebars.overview', ['studyId' => $substudy->study->id, 'substudyId'=> $substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => (Auth::user()->isAdmin || $substudy->study->contributors->contains(Auth::user()))])
    @if( (count($substudy->questiongroups) > 0) )
        <h3>{{ HTML::linkRoute('studies.substudies.questionsgroups.editorder', trans('pagestrings.substudies_rmenu_editquestiongrouporderlink'), [$substudy->study->id, $substudy->id])}}</h3>
    @endif
@stop

@section('content')


    @if( (count($substudy->questiongroups) > 0) )
        {{ Form::open(['route' => ['studies.substudies.questionsgroups.updateorder', "studies" => $substudy->study->id, "substudies" => $substudy->id_in_study], 'method' => 'PUT']) }}
        <table id ="questiongroups" class="table table-striped ">
            <thead>
            <tr>
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
                    <td>{{ Bootstrap::number('substudy_order[' . $questiongroup->id_in_substudy . ']', null, $questiongroup->sequence_indicator, null, array('min' => 0, 'step' => 1)) }}</td>
                    <td>{{ HTML::linkRoute('studies.substudies.questiongroups.show', $questiongroup->shortname, ['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study, "questiongroups" => $questiongroup->id_in_substudy]) }}</td>
                    <td>{{ $questiongroup->name }}</td>
                    <td>{{ $questiongroup->questions->count() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <hr/>
        <div class="col-md-3 col-md-offset-9"> {{ Bootstrap::submit(trans('pagestrings.questiongroup_edit_createbutton')) }} </div>
        {{Form::close()}}
    @else
        <h2>{{ trans('pagestrings.questiongroup_index_questiongroups') }}</h2>
    @endif
@stop