@extends('layouts.template')

@section('title', trans('pagestrings.substudies_create_header', ['study_name'=>$study->name]))

@section('header', trans('pagestrings.substudies_create_header', ['study_name'=>$study->name]))

@section('sidebar')
    @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
    @include('substudies.sidebars.overview', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
@stop
@section('content')
    {{ Form::open(['route' => ['studies.substudies.store', "studies" => $study->id], 'method' => 'POST']) }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.studies_create_panelheader') }}</h3>
        </div>

        <div class="panel-body">
            <!-- Name fields -->
            <div class="row">
                <div class="col-md-6">
                    {{ Bootstrap::text('name', trans('pagestrings.substudies_name_long')) }}
                    {{ show_errors_for('name', $errors) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {{ Bootstrap::textarea('description', trans('pagestrings.substudies_description'), null, [], ['rows' => '4'])}}
                    {{ show_errors_for('description', $errors) }}
                </div>
                <div class="col-md-6">
                    {{ Bootstrap::textarea('comment', trans('pagestrings.substudies_comment'), null, [], ['rows' => '4'])}}
                    {{ show_errors_for('comment', $errors) }}
                </div>
            </div>
            
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
            <div class="col-sm-5">
                <br>
                {{ Bootstrap::submit(trans('pagestrings.substudies_create_createbutton')) }}
            </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    <h4></h4>

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