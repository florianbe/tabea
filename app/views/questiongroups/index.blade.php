@extends('layouts.template')

@section('title', trans('pagestrings.questiongroup_index_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('header', trans('pagestrings.questiongroup_index_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('sidebar')
    @include('questiongroups.sidebars.overview', ['studyId' => $substudy->study->id, 'substudyId'=> $substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => (Auth::user()->isAdmin || $substudy->study->contributors->contains(Auth::user()))])
@stop

@section('content')


    @if( (count($substudy->questiongroups) > 0) )
        <table id ="questiongroups" class="table table-striped ">
            <thead>
            <tr>
                <th class="col-md-1"><a href="{{route('studies.substudies.questionsgroups.editorder',[$substudy->study->id, $substudy->id_in_study])}}"><i class="fa fa-pencil fa-lg"></i></a></th>
                <th class="col-md-2"></th>
                <th class="col-md-2">{{ trans('pagestrings.questiongroup_shortname') }}</th>
                <th class="col-md-5">{{ trans('pagestrings.questiongroup_name') }}</th>
                <th class="col-md-2">{{ trans('pagestrings.questiongroup_countquestions') }}</th>
            </tr>
            </thead>
            <tbody>
            <h3></h3>
            @foreach ($substudy->questiongroups->sortBy('sequence_indicator')  as $questiongroup)
                <tr id="{{ 'tr_' . $questiongroup->sequence_indicator }}">
                    <td class="vert-align">{{ $questiongroup->sequence_indicator }}</td>
                    <td class="vert-align">
                        <div class="row">
                            <div class="col-sm-4"><a href="{{route('studies.substudies.questiongroups.show',['studies' => $questiongroup->substudy->study->id, 'substudies' => $questiongroup->substudy->id_in_study, "questiongroups" => $questiongroup->id_in_substudy]) }}"><i class="fa fa-file-text-o"></i></a></div>
                            <div class="col-sm-4"><a href="{{route('studies.substudies.questiongroups.edit',[$questiongroup->substudy->study->id, $questiongroup->substudy->id_in_study, $questiongroup->id_in_substudy])}}"><i class="fa fa-pencil"></i></a></div>
                            <div class="col-sm-4"><a href="" class="btn-delete" data-seq_id="{{ $questiongroup->sequence_indicator }}" data-token="{{ csrf_token() }}" data-item_id="{{$questiongroup->id_in_substudy }}"><i class="fa fa-trash-o"></i></a></div>
                        </div>
                    </td>
                    <td class="vert-align">{{ $questiongroup->shortname }}</td>
                    <td class="vert-align">{{ $questiongroup->name}}</td>
                    <td class="vert-align">{{ $questiongroup->questions->count() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr/>
        <div class="list-group-item">
            <div class="list-group-item-text">
                <div class="row">
                    <div class="col-md-6 text-left">
                    @if( (count($substudy->questiongroups) > 0) )
                        <a class="btn btn-primary" href="{{route('studies.substudies.questionsgroups.editorder',[$questiongroup->substudy->study->id, $questiongroup->substudy->id_in_study])}}">{{ trans('pagestrings.editorder') }}</a></div>
                    @endif
                    <div class="col-md-6 text-right"><a class="btn btn-primary" href="{{route('studies.substudies.questiongroups.create', [$questiongroup->substudy->study->id,  $questiongroup->substudy->id])}}"><i class="icon-plus-sign"></i>  {{ trans('pagestrings.substudies_rmenu_questiongrouplinknew') }}</a></div>
                </div>
            </div>
        </div>
    @else
        <h2>{{ trans('pagestrings.questiongroup_index_questiongroups') }}</h2>
    @endif
@stop

@section('javascript')
    <script type="text/javascript">
        var m_answer = '{{ trans('pagestrings.questiongroup_delete_confirm') }}';
        var m_success = '{{ trans('pagestrings.questiongroup_delete_successmessage_a') }}';
        var route = '{{route('studies.substudies.questiongroups.destroy',[$questiongroup->substudy->study->id, $questiongroup->substudy->id_in_study, '__id__'])}}';
        var m_error = '{{ trans('pagestrings.errormessage_reload') }}';
    </script>
    {{ HTML::script('js/tabea.js') }}
@stop


