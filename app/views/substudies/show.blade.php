@extends('layouts.template')

@section('title', (trans('pagestrings.substudies_detail_header', ['study_name' => $substudy->study->short_name, 'substudy_name' => $substudy->name])))

@section('header', (trans('pagestrings.substudies_detail_header', ['study_name' => $substudy->study->name, 'substudy_name' => $substudy->name])))

@section('sidebar')
    @include('substudies.sidebars.detail', ['studyId' => $substudy->study->id, 'substudyId'=> $substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => (Auth::user()->isAdmin || $substudy->study->contributors->contains(Auth::user()))])
@stop
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.substudies_detail_panelheader', ['study_name' => $substudy->study->name, 'substudy_name' => $substudy->name]) }}</h3>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4"><strong>{{trans('pagestrings.substudies_name_long')}}:</strong></div>
                        <div class="col-md-8">{{ $substudy->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>{{trans('pagestrings.substudies_signal_type')}}:</strong></div>
                        <div class="col-md-8">{{$substudy->getTriggerName()}}</div>
                    </div>
                    @if($substudy->getTrigger() != "EVENT")
                    <div class="row">
                        <div class="col-md-4"><strong>{{$substudy->getTrigger() == 'FIX' ? trans('pagestrings.substudies_signal_timefixtime') : trans('pagestrings.substudies_signal_timeflextime')}}:</strong></div>
                        <div class="col-md-8">{{$substudy->trigger_time_interval}}</div>
                    </div>
                    @endif()
                </div>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading">{{trans('pagestrings.substudies_comment')}}:</h4>
                <div class="list-group-item-text">
                    <p>{{$substudy->comment}}</p>
                </div>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading">{{trans('pagestrings.substudies_description')}}:</h4>
                <div class="list-group-item-text">
                    <p>{{$substudy->description}}</p>
                </div>
            </div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading">{{ trans('pagestrings.substudies_surveyperiod_header') }}</h4>
                @if($substudy->SurveyPeriods->count() <= 0)
                    {{ trans('pagestrings.substudies_surveyperiod_none') }}
                @else
                    <table id ="surveyperiods" class="table table-striped ">
                        <thead>
                        <tr>
                            <th class="col-sm-2">{{ trans('pagestrings.substudies_surveyperiod_start_short') }}</th>
                            <th class="col-sm-2">{{ trans('pagestrings.substudies_surveyperiod_end_short') }}</th>
                            <th class="col-sm-1">{{ trans('pagestrings.short_Mo') }}</th>
                            <th class="col-sm-1">{{ trans('pagestrings.short_Tu') }}</th>
                            <th class="col-sm-1">{{ trans('pagestrings.short_We') }}</th>
                            <th class="col-sm-1">{{ trans('pagestrings.short_Th') }}</th>
                            <th class="col-sm-1">{{ trans('pagestrings.short_Fr') }}</th>
                            <th class="col-sm-1">{{ trans('pagestrings.short_Sa') }}</th>
                            <th class="col-sm-1">{{ trans('pagestrings.short_Su') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($substudy->SurveyPeriods as $survPer)
                                <tr>
                                    <td>{{ format_datetime_to_display($survPer->start_date) }}</td>
                                    <td>{{ format_datetime_to_display($survPer->end_date) }}</td>
                                    @foreach($survPer->getWeekdays() as $day => $set)
                                        <td>{{ $set ? '<i class="fa fa-check-square-o fa-lg"></i>' : '' }}</td>
                                    @endforeach
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@stop
