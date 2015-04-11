@extends('layouts.template')

@section('title', trans('pagestrings.substudies_index_header', ['study_name' => $study->short_name]))

@section('header', trans('pagestrings.substudies_index_header', ['study_name' => $study->name])))

@section('sidebar')
    @include('substudies.sidebars.overview', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
@stop
@section('content')


    @if( (count($study->substudies) > 0) )
        {{Form::open()}}
        <table id ="substudies" class="table table-striped ">
            <thead>
            <tr>
                <th class="col-md-1"></th>
                <th class="col-md-2"></th>
                <th class="col-md-7">{{ trans('pagestrings.substudies_name') }}</th>
                <th class="col-md-2">{{ trans('pagestrings.substudies_signal_type') }}</th>
            </tr>
            </thead>
            <tbody>
            <h3></h3>
            @foreach ($study->substudies->sortBy('id_in_study') as $su_index =>  $substudy)
                <tr id="{{ 'tr_' . $substudy->id_in_study }}">
                    <td class="vert-align">{{ $su_index + 1 }}</td>
                    <td class="vert-align">
                        <div class="row">
                            <div class="col-sm-4"><a href="{{route('studies.substudies.show',['studies' => $substudy->study->id, 'substudies' => $substudy->id_in_study]) }}"><i class="fa fa-file-text-o"></i></a></div>
                            <div class="col-sm-4"><a href="{{route('studies.substudies.edit',[$substudy->study->id, $substudy->id_in_study])}}"><i class="fa fa-pencil"></i></a></div>
                            <div class="col-sm-4"><a href="" class="btn-delete" data-seq_id="{{ $substudy->id_in_study }}" data-token="{{ csrf_token() }}" data-item_id="{{$substudy->id_in_study }}"><i class="fa fa-trash-o"></i></a></div>
                        </div>
                    </td>
                    <td class="vert-align">{{ $substudy->name}}</td>
                    <td class="vert-align">{{ $substudy->getTriggerName()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr/>
    @else
        <h2>{{ trans('pagestrings.substudies_index_nosubstudies') }}</h2>
    @endif
    <div class="list-group-item">
        <div class="list-group-item-text">
            <div class="row">
                <div class="col-md-6 text-left"></div>
                <div class="col-md-6 text-right"><a class="btn btn-primary" href="{{route('studies.substudies.create', [$substudy->id])}}"><i class="fa icon-plus-sign"></i>  {{ trans('pagestrings.substudies_rmenu_createlink') }}</a></div>
            </div>
        </div>
    </div>

@stop


@section('javascript')
    @if( (count($study->substudies) > 0) )
    <script type="text/javascript">
        var m_answer = '{{ trans('pagestrings.questiongroup_delete_confirm') }}';
        var m_success = '{{ trans('pagestrings.questiongroup_delete_successmessage_a') }}';
        var route = '{{route('studies.substudies.destroy',[$substudy->study->id, '__id__'])}}';
        var m_error = '{{ trans('pagestrings.errormessage_reload') }}';
    </script>
    @endif
    {{ HTML::script('js/tabea.js') }}
@stop