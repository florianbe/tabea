@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_show_header', ['substudy_name' => $questiongroup->substudy->name, 'questiongroup_name' => $questiongroup->shortname]))

@section('header', trans('pagestrings.questiongroup_show_header', ['substudy_name' => $questiongroup->substudy->name, 'questiongroup_name' => $questiongroup->name]))

@section('sidebar')
    @include('questiongroups.sidebars.detail', ['studyId' => $questiongroup->substudy->study->id, 'substudyId'=> $questiongroup->substudy->id_in_study, 'questiongroupId' => $questiongroup->id_in_substudy, 'hasAccess' => Auth::user()->hasAccessToStudy($questiongroup->substudy->study), 'canContribute' => (Auth::user()->isAdmin || $questiongroup->substudy->study->contributors->contains(Auth::user()))])
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
        <div class="list-group-item">
            <h4 class="list-group-item-heading">{{ trans('pagestrings.questiongroup_questionheader')  }}</h4>
            <div class="list-group-item-text">
                <table id ="questiongroups" class="table table-striped ">
                    <thead>
                    <tr>
                        <th class="col-sm-1"><a href="{{route('studies.substudies.questionsgroups.questions.editorder',[$questiongroup->substudy->study->id, $questiongroup->substudy->id_in_study, $questiongroup->id_in_substudy])}}"><i class="fa fa-pencil fa-lg"></i></a></th>
                        <th class="col-sm-2"></th>
                        <th class="col-sm-2">{{ trans('pagestrings.question_shortname') }}</th>
                        <th class="col-sm-2">{{ trans('pagestrings.question_type') }}</th>
                        <th class="col-sm-5">{{ trans('pagestrings.question_text') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                    <h3></h3>
                    @foreach ($questiongroup->questions as $question)
                        <tr id="{{ 'tr_' . $question->sequence_indicator }}">
                            <td class="vert-align">{{ $question->sequence_indicator }}</td>
                            <td class="vert-align">
                                <div class="row">
                                    <div class="col-sm-4"><a href="{{route('studies.substudies.questiongroups.questions.show',['studies' => $questiongroup->substudy->study->id, 'substudies' => $questiongroup->substudy->id_in_study, "questiongroups" => $questiongroup->id_in_substudy, "questions" => $question->id_in_questiongroup]) }}"><i class="fa fa-file-text-o"></i></a></div>
                                    <div class="col-sm-4"><a href="{{route('studies.substudies.questiongroups.questions.edit',[$questiongroup->substudy->study->id, $questiongroup->substudy->id_in_study, $questiongroup->id_in_substudy, $question->id_in_questiongroup])}}"><i class="fa fa-pencil"></i></a></div>
                                    <div class="col-sm-4"><a href="" class="btn-delete" data-seq_id="{{ $question->sequence_indicator }}" data-token="{{ csrf_token() }}" data-item_id="{{$question->id_in_questiongroup }}"><i class="fa fa-trash-o"></i></a></div>
                                </div>
                            </td>
                            <td class="vert-align">{{ $question->shortname }}</td>
                            <td class="vert-align">{{ $question->text}}</td>
                            <td class="vert-align">{{ trans('pagestrings.question_typename_' . $question->questiontype->code) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="list-group-item">
            <div class="list-group-item-text">
                <div class="row">
                    <div class="col-md-6 text-left"><a class="btn btn-primary" href="{{route('studies.substudies.questionsgroups.questions.editorder',[$questiongroup->substudy->study->id, $questiongroup->substudy->id_in_study, $questiongroup->id_in_substudy])}}">{{ trans('pagestrings.editorder') }}</a></div>
                    <div class="col-md-6 text-right"><a class="btn btn-primary" href="{{route('studies.substudies.questiongroups.questions.create', [$questiongroup->substudy->study->id,  $questiongroup->substudy->id, $questiongroup->id_in_substudy])}}"><i class="icon-plus-sign"></i>  {{ trans('pagestrings.substudies_rmenu_newquestion') }}</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div class="list-group-item-text">
            <div class="row">
                <div class="col-md-6 text-left"></div>
                <div class="col-md-6 text-right"><a class="btn btn-primary" href="{{route('studies.substudies.questiongroups.edit', [$questiongroup->substudy->study->id,  $questiongroup->substudy->id, $questiongroup->id_in_substudy])}}"><i class="icon-plus-sign"></i>  {{ trans('pagestrings.questiongroups_rmenu_editlink') }}</a></div>
            </div>
        </div>
    </div>


@stop

@section('javascript')
    <script type="text/javascript">
        var m_answer = '{{ trans('pagestrings.question_delete_confirm') }}';
        var m_success = '{{ trans('pagestrings.questions_delete_successmessage_a') }}';
        var route = '{{route('studies.substudies.questiongroups.questions.destroy',[$questiongroup->substudy->study->id, $questiongroup->substudy->id_in_study, $questiongroup->id_in_substudy, '__id__'])}}';
        var m_error = '{{ trans('pagestrings.errormessage_reload') }}';
    </script>
    {{ HTML::script('js/tabea.js') }}
@stop

