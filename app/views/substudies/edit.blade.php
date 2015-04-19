@extends('layouts.template')

@section('title', trans('pagestrings.substudies_edit_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('header', trans('pagestrings.substudies_edit_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('sidebar')
    @include('substudies.sidebars.detail', ['studyId' => $substudy->study->id, 'substudyId'=> $substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => ($substudy->study->hasEditAccess(Auth::user()))])
@stop
@section('content')
    @if($substudy->study->isStudyEditable() && ($substudy->study->hasEditAccess(Auth::user())))
    {{ Form::model($substudy, ['route' => ['studies.substudies.update', "studies" => $substudy->study->id, "substudies" => $substudy->id_in_study], 'method' => 'PUT']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.substudies_edit_panelheader') }}</h3>
        </div>

        <div class="panel-body">

            <!-- Name fields -->
            <div class="row">
                <div class="col-md-6">
            {{ Bootstrap::text('name', trans('pagestrings.substudies_name_long'), $substudy->name) }}
            {{ show_errors_for('name', $errors) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {{ Bootstrap::textarea('description', trans('pagestrings.substudies_description'), $substudy->description, [], ['rows' => '3'])}}
                    {{ show_errors_for('description', $errors) }}
                </div>
                <div class="col-md-6">
                    {{ Bootstrap::textarea('comment', trans('pagestrings.substudies_comment'), $substudy->comment, [], ['rows' => '3'])}}
                    {{ show_errors_for('comment', $errors) }}
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    {{ Bootstrap::select('signaltype', trans('pagestrings.substudies_signal_type'), ['EVENT' => trans('pagestrings.substudies_signal_event'), 'FIX' => trans('pagestrings.substudies_signal_timefix'), 'FLEX' => trans('pagestrings.substudies_signal_timeflex')], $substudy->getTrigger()) }}
                </div>
                <div class="col-sm-4">
                    <div class="form-group hidable">
                        <label for="intervaltime">{{trans('pagestrings.substudies_signal_timefixtime')}}</label>
                        <input type="number" min="1" step="1" class="form-control" name="intervaltime" value={{$substudy->trigger_time_interval}}>
                        {{ show_errors_for('intervaltime', $errors) }}
                    </div>
                </div>
                <div class="col-sm-5">

                </div>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div class="list-group-item-text">
            <div class="row">
                <div class="col-md-6 text-left"><a class="btn btn-primary btn-back" >{{ trans('pagestrings.back') }}</a></div>
                <div class="col-md-6 text-right"> {{ Bootstrap::submit(trans('pagestrings.substudies_edit_editbutton')) }}</div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    <h2>{{ trans('pagestrings.substudies_surveyperiod_header') }}</h2>
    @if($substudy->SurveyPeriods->count() <= 0)
        {{ trans('pagestrings.substudies_surveyperiod_none') }}
    @else
        <table id ="surveyperiods" class="table table-striped ">
            <thead>
            <tr>
                <th class="col-sm-1"></th>
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
                @if($survPer != $surveyperiod)
                <tr>
                    <td>
                        <div class="row text-center">
                            <div class="col-md-6"><a href="{{route('studies.substudies.surveytime.edit', ["studies" => $survPer->substudy->study->id, "substudies" => $survPer->substudy->id_in_study, "surveytime" => $survPer->id_in_substudy])}}"><i class="fa fa-pencil"></i></a></div>
                            <div class="col-md-6"><div class="col-sm-4"><a href="" class="btn-delete" data-token="{{ csrf_token() }}" data-item_id="{{$survPer->id_in_substudy }}"><i class="fa fa-trash-o"></i></a></div></div>
                        </div>
                    </td>
                    <td>{{ format_datetime_to_display($survPer->start_date) }}</td>
                    <td>{{ format_datetime_to_display($survPer->end_date) }}</td>
                    @foreach($survPer->getWeekdays() as $day => $set)
                    <td>{{ $set ? '<i class="fa fa-check-square-o fa-lg"></i>' : '' }}</td>
                    @endforeach
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif
    <hr>
    @if($surveyperiod==null)
    {{ Form::open(['route' => ['studies.substudies.surveytime.new', "studies" => $substudy->study->id, "substudies" => $substudy->id_in_study], 'method' => 'POST', 'class' => 'form-inline‚']) }}
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="surveyperiod_start" class="control-label ">{{ trans('pagestrings.substudies_surveyperiod_start') }}</label>
                <div id="date_surveyperiod_start" class="input-group date datetimepicker">
                    <input class="form-control" name="surveyperiod_start" type="text" id="surveyperiod_start" />
                    <span class="input-group-addon"><span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            {{ show_errors_for('surveyperiod_start', $errors) }}
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="surveyperiod_end" class="control-label ">{{ trans('pagestrings.substudies_surveyperiod_end') }}</label>
                <div id="date_surveyperiod_end" class="input-group date datetimepicker">
                    <input class="form-control" name="surveyperiod_end" type="text" id="surveyperiod_end" />
                    <span class="input-group-addon"><span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            {{ show_errors_for('surveyperiod_start', $errors) }}
        </div>
            <div class="col-md-3">
                <div class="row">
                    <br>
                    <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="MO"><strong>{{ trans('pagestrings.short_Mo') }} </strong></label></div>

                    <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="TU"><strong>{{ trans('pagestrings.short_Tu') }} </strong></label></div>
                    <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="WE"><strong>{{ trans('pagestrings.short_We') }} </strong></label></div>
                    <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="TH"><strong>{{ trans('pagestrings.short_Th') }} </strong></label></div>
                    <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="FR"><strong>{{ trans('pagestrings.short_Fr') }} </strong></label></div>
                </div>
                <div class="row">
                    <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="SA"><strong>{{ trans('pagestrings.short_Sa') }} </strong></label></div>
                    <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="SU"><strong>{{ trans('pagestrings.short_Su') }} </strong></label></div>
                </div>
            </div>
            <div class="col-md-1">
                <br>
                <div class="row">
                    <div class="checkbox-inline"><label><input type="checkbox" name="WEEKDAYS" value="WEEKDAYS"><strong>{{ trans('pagestrings.short_MoFr') }}</strong></label></div>
                </div>
                <div class="row">
                    <div class="checkbox-inline"><label><input type="checkbox" name="ALLDAYS" value="ALLDAYS"><strong>{{ trans('pagestrings.short_MoSu') }}</strong></label></div>
                </div>
            </div>
            <div class="col-md-2"><br>{{ Bootstrap::submit(trans('pagestrings.substudies_edit_surveyperiod_new')) }}</div>
        </div>
    {{Form::close()}}
    @else
    {{ Form::open(['route' => ['studies.substudies.surveytime.update', "studies" => $substudy->study->id, "substudies" => $substudy->id_in_study, "surveyperiod" => $surveyperiod->id_in_substudy], 'method' => 'PUT', 'class' => 'form-inline‚']) }}
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="surveyperiod_start" class="control-label ">{{ trans('pagestrings.substudies_surveyperiod_start') }}</label>
                <div id="date_surveyperiod_start" class="input-group date datetimepicker">
                    <input class="form-control" name="surveyperiod_start" type="text" id="surveyperiod_start" value="{{ $surveyperiod->start_date->format('d.m.Y H:i') }}"/>
                        <span class="input-group-addon"><span class="fa fa-calendar"></span>
                        </span>
                </div>
            </div>
            {{ show_errors_for('surveyperiod_start', $errors) }}
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="surveyperiod_end" class="control-label ">{{ trans('pagestrings.substudies_surveyperiod_end') }}</label>
                <div id="date_surveyperiod_end" class="input-group date datetimepicker">
                    <input class="form-control" name="surveyperiod_end" type="text" id="surveyperiod_end" value="{{ $surveyperiod->end_date->format('d.m.Y H:i') }}"/>
                        <span class="input-group-addon"><span class="fa fa-calendar"></span>
                        </span>
                </div>
            </div>
            {{ show_errors_for('surveyperiod_start', $errors) }}
        </div>

        <div class="col-md-3">
            <div class="row">
                <br>
                <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="MO" {{$surveyperiod->isDaySet('MO') ? 'checked="checked"' : ''}}><strong>{{ trans('pagestrings.short_Mo') }} </strong></label></div>
                <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="TU" {{$surveyperiod->isDaySet('TU') ? 'checked="checked"' : ''}}><strong>{{ trans('pagestrings.short_Tu') }} </strong></label></div>
                <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="WE" {{$surveyperiod->isDaySet('WE') ? 'checked="checked"' : ''}}><strong>{{ trans('pagestrings.short_We') }} </strong></label></div>
                <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="TH" {{$surveyperiod->isDaySet('TH') ? 'checked="checked"' : ''}}><strong>{{ trans('pagestrings.short_Th') }} </strong></label></div>
                <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="FR" {{$surveyperiod->isDaySet('FR') ? 'checked="checked"' : ''}}><strong>{{ trans('pagestrings.short_Fr') }} </strong></label></div>
            </div>
            <div class="row">
                <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="SA" {{$surveyperiod->isDaySet('SA') ? 'checked="checked"' : ''}}><strong>{{ trans('pagestrings.short_Sa') }} </strong></label></div>
                <div class="checkbox-inline"><label><input type="checkbox" name="days[]" value="SU" {{$surveyperiod->isDaySet('SU') ? 'checked="checked"' : ''}}><strong>{{ trans('pagestrings.short_Su') }} </strong></label></div>
            </div>
        </div>
        <div class="col-md-1">
            <br>
            <div class="row">
                <div class="checkbox-inline"><label><input type="checkbox" name="WEEKDAYS" value="WEEKDAYS"><strong>{{ trans('pagestrings.short_MoFr') }}</strong></label></div>
            </div>
            <div class="row">
                <div class="checkbox-inline"><label><input type="checkbox" name="WEEKDAYS" value="ALLDAYS"><strong>{{ trans('pagestrings.short_MoSu') }}</strong></label></div>
            </div>
        </div>
        <div class="col-md-2"><br>{{ Bootstrap::submit(trans('pagestrings.substudies_edit_surveyperiod_save')) }}</div>
    </div>
    {{Form::close()}}
    @endif
    <div class="row">
        <div class="col-md-6">
            <p>{{ trans('pagestrings.substudies_edit_surveyperiod_timehint') }}</p>
        </div>
        <div class="col-md-6">

        </div>
    </div>
    @endif
@stop


@section('javascript')
    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker({
                pickTime: true,
                minDate: '{{ $substudy->study->accessible_from->format('d/m/Y') }}',
                maxDate: '{{ $substudy->study->accessible_until->format('d/m/Y') }}',
                language: '{{ App::getLocale() }}',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });
        });

        $(document).ready(function()
        {
            var sigsel = $('#signaltype').val();

            if (sigsel === 'FIX' || sigsel === 'FLEX')
            {
                $('.hidable').show();
            }
            else
            {
                $('.hidable').hide();
            }


        });

        $('#signaltype').change(function()
        {
            var sigsel = $('#signaltype').val();

            if (sigsel === 'FIX' || sigsel === 'FLEX')
            {
                $('.hidable').show();
            }
            else
            {
                $('.hidable').hide();
            }
        })
        @if( (count($substudy->questiongroups) > 0 && $substudy->study->isStudyEditable()) && ($substudy->study->hasEditAccess(Auth::user())) )
            var m_answer = '{{ trans('pagestrings.substudies_surveyperiod_delete_confirm') }}';
            var m_success = '{{ trans('pagestrings.substudies_surveyperiod_deletemessage_a') }}';
            var route = '{{route('studies.substudies.surveytime.delete',[$substudy->study->id, $substudy->id_in_study, '__id__'])}}';
            var m_error = '{{ trans('pagestrings.errormessage_reload') }}';
        @endif
    </script>





    {{ HTML::script('js/tabea.js') }}
@stop