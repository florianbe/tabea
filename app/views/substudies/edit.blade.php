@extends('layouts.template')

@section('title', trans('pagestrings.substudies_edit_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('header', trans('pagestrings.substudies_edit_header', ['study_name'=>$substudy->study->name, 'substudy_name'=>$substudy->name]))

@section('sidebar')
    @include('studies.sidebars.detail', ['studyId' => $substudy->study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => (Auth::user()->isAdmin || $substudy->study->contributors->contains(Auth::user()))])
    @include('substudies.sidebars.detail', ['studyId' => $substudy->study->id, 'substudyId'=> $substudy->id_in_study, 'hasAccess' => Auth::user()->hasAccessToStudy($substudy->study), 'canContribute' => (Auth::user()->isAdmin || $substudy->study->contributors->contains(Auth::user()))])
@stop
@section('content')
    {{ Form::open(['route' => ['studies.substudies.update', "studies" => $substudy->study->id, "substudies" => $substudy->id_in_study], 'method' => 'PUT']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.studies_edit_panelheader') }}</h3>
        </div>

        <div class="panel-body">

            <!-- Name fields -->
            {{ Bootstrap::text('name', trans('pagestrings.substudies_name_long')) }}
            {{ show_errors_for('name', $errors) }}

            {{ Bootstrap::textarea('description', trans('pagestrings.substudies_description'), null, [], ['rows' => '4'])}}
            {{ show_errors_for('description', $errors) }}


            {{ Bootstrap::textarea('comment', trans('pagestrings.substudies_comment'), null, [], ['rows' => '4'])}}
            {{ show_errors_for('comment', $errors) }}
            <div class="row">
                <div class="col-sm-3">
                    {{ Bootstrap::select('signaltype', trans('pagestrings.substudies_signal_type'), ['EVENT' => trans('pagestrings.substudies_signal_event'), 'FIX' => trans('pagestrings.substudies_signal_timefix'), 'FLEX' => trans('pagestrings.substudies_signal_timeflex')]) }}
                </div>
                <div class="col-sm-4">
                    <div class="form-group hidable">
                        <label for="intervaltime">{{trans('pagestrings.substudies_signal_timefixtime')}}</label>
                        <input type="number" min="1" step="1" class="form-control" name="intervaltime" placeholder="{{trans('pagestrings.substudies_signal_timefixtime')}}">
                        {{ show_errors_for('intervaltime', $errors) }}
                    </div>
                </div>

            </div>
            {{ Bootstrap::submit(trans('pagestrings.substudies_edit_editbutton')) }}
        </div>
    </div>
    {{ Form::close() }}
    <h2>{{ trans('pagestrings.substudies_edit_surveyperiod_header') }}</h2>
    @if($substudy->SurveyPeriods->count() <= 0)
        {{ trans('pagestrings.substudies_edit_surveyperiod_none') }}
    @else

        @if($surveyperiod != null)

        @endif
    @endif
@stop


@section('javascript')
    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker({
                pickTime: true,
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
    </script>
@stop