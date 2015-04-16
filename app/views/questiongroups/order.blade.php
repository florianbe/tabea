@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_editorder_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('header', trans('pagestrings.questiongroup_editorder_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('sidebar')
    @include('questiongroups.sidebars.overview', ['studyId' => $substudy->study->id, 'substudyId'=> $substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => ($substudy->study->hasEditAccess(Auth::user()))])
@stop

@section('content')
    @if($substudy->study->isStudyEditable() && ($substudy->study->hasEditAccess(Auth::user())))
    @if( (count($substudy->questiongroups) > 0) )
        {{ Form::open(['route' => ['studies.substudies.questionsgroups.updateorder', "studies" => $substudy->study->id, "substudies" => $substudy->id_in_study], 'method' => 'PUT']) }}
        <table id ="questiongroups" class="table table-striped ">
            <thead>
            <tr>
                <th class="col-md-2"></th>
                <th class="col-md-2">{{ trans('pagestrings.questiongroup_shortname') }}</th>
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
        <div class="list-group-item">
            <div class="list-group-item-text">
                <div class="row">
                    <div class="col-md-6 text-left"><a class="btn btn-primary btn-back" >{{ trans('pagestrings.back') }}</a></div>
                    <div class="col-md-6 text-right"> {{ Bootstrap::submit(trans('pagestrings.questiongroup_saveorderbutton')) }} </div>
                </div>
            </div>
        </div>
        {{Form::close()}}
    @else
        <h2>{{ trans('pagestrings.questiongroup_index_questiongroups') }}</h2>
    @endif
    @endif
@stop

@section('javascript')
    {{ HTML::script('js/tabea.js') }}
@stop
