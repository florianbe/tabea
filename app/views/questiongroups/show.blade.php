@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_show_header', ['substudy_name' => $questiongroup->substudy->name, 'questiongroup_name' => $questiongroup->shortname]))

@section('header', trans('pagestrings.questiongroup_show_header', ['substudy_name' => $questiongroup->substudy->name, 'questiongroup_name' => $questiongroup->name]))

@section('sidebar')
    @include('questiongroups.sidebars.detail', ['studyId' => $questiongroup->substudy->study->id, 'substudyId'=> $questiongroup->substudy->id_in_study, 'questiongroupId' => $questiongroup->id_in_substudy, 'hasAccess' => Auth::user()->hasAccessToStudy($questiongroup->substudy->study), 'canContribute' => (Auth::user()->isAdmin || $questiongroup->substudy->study->contributors->contains(Auth::user()))])
    <h3 >{{ HTML::linkRoute('studies.substudies.questiongroups.questions.create', trans('pagestrings.substudies_rmenu_newquestion'), [$questiongroup->substudy->study->id,  $questiongroup->substudy->id, $questiongroup->id])}}</h3>
@stop

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.questiongroup_show_panelheader') }}</h3>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-2"><strong>{{trans('pagestrings.questiongroup_name')}}:</strong></div>
                    <div class="col-md-10">{{ $questiongroup->name }}</div>
                </div>
                <div class="row">
                    <div class="col-md-2"><strong>{{trans('pagestrings.questiongroup_shortname')}}:</strong></div>
                    <div class="col-md-4">{{$questiongroup->shortname}}</div>
                    <div class="col-md-3">{{trans('pagestrings.questiongroup_randomquestionorder')}}<strong>:</strong></div>
                    <div class="col-md-3">{{$questiongroup->random_questionorder ?  trans('pagestrings.yes') : trans('pagestrings.no')}}</div>
                </div>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading">{{trans('pagestrings.questiongroup_comment')}}:</h4>
                <div class="list-group-item-text">
                    <p>{{$questiongroup->comment}}</p>
                </div>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading">{{trans('pagestrings.questiongroup_description')}}:</h4>
                <div class="list-group-item-text">
                    <p>{{$questiongroup->description}}</p>
                </div>
            </div>
        </div>
        <table id ="questiongroups" class="table table-striped ">
            <thead>
            <tr>
                <th class="col-md-3">{{ trans('pagestrings.question_shortname') }}</th>
                <th class="col-md-6">{{ trans('pagestrings.question_text') }}</th>
                <th class="col-md-3">{{ trans('pagestrings.question_type') }}</th>
            </tr>
            </thead>
            <tbody>
            <h3></h3>
            @foreach ($questiongroup->questions as $question)
                <tr>
                    <td>{{ HTML::linkRoute('studies.substudies.questiongroups.questions.show', $question->shortname, ['studies' => $questiongroup->substudy->study->id, 'substudies' => $questiongroup->substudy->id_in_study, "questiongroups" => $questiongroup->id_in_substudy, "questions" => $question->id_in_questiongroup]) }}</td>
                    <td>{{ $question->text}}</td>
                    <td>{{ trans('pagestrings.question_typename_' . $question->questiontype->code) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@stop
