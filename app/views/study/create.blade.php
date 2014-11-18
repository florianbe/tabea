@extends('layouts.template')

@section('title', trans('pagestrings.studies_create_header'))

@section('header', trans('pagestrings.studies_create_header'))

@section('sidebar')
       @include('study.sidebars.overview')
@stop
@section('content') 

    {{ Form::open(['route' => 'study.store', ]) }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.studies_create_panelheader') }}</h3>
            </div>

            <div class="panel-body">

                <!-- Name fields -->
                {{ Bootstrap::text('name', trans('pagestrings.studies_name_long')) }}
                {{ show_errors_for('name', $errors) }}

                {{ Bootstrap::text('short_name', trans('pagestrings.studies_name_short')) }}
                {{ show_errors_for('short_name', $errors) }}

                 {{ Bootstrap::text('studypassword', trans('pagestrings.studies_studypassword')) }}
                 {{ show_errors_for('studypassword', $errors) }}

                {{ Bootstrap::textarea('description', trans('pagestrings.studies_description') ) }}
                {{ show_errors_for('description', $errors) }}

                {{ Bootstrap::textarea('comment', trans('pagestrings.studies_comment') ) }}
                {{ show_errors_for('comment', $errors) }}


                <div class="form-group">
                <label for="accessible_from" class="control-label ">{{ trans('pagestrings.studies_accessible_from_label') }}</label>
                    <div id="date_accessible_from" class="input-group date datepicker">
                        <input class="form-control" name="accessible_from" type="text" id="accessible_from"/>
                        <span class="input-group-addon"><span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
                {{ show_errors_for('accessible_from', $errors) }}

                <div class="form-group">
                <label for="accessible_until" class="control-label ">{{ trans('pagestrings.studies_accessible_until_label') }}</label>
                    <div id="date_accessible_until" class="input-group date datepicker">
                        <input class="form-control" name="accessible_until" type="text" id="accessible_until"/>
                        <span class="input-group-addon"><span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
                {{ show_errors_for('accessible_until', $errors) }}

                <div class="form-group">
                    <label for="uploadable_until" class="control-label ">{{ trans('pagestrings.studies_uploadable_until_label') }}</label>
                    <div id="date_accessible_from" class="input-group date datepicker">
                        <input class="form-control" name="uploadable_until" type="text" id="uploadable_until"/>
                        <span class="input-group-addon"><span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
                {{ show_errors_for('uploadable_until', $errors) }}

                 {{ Bootstrap::submit(trans('pagestrings.studies_create_createbutton')) }}
            </div>
        </div>
        {{ Form::close() }}  
@stop

@section('javascript')
    <script type="text/javascript">
          $(function () {
              $('.datepicker').datetimepicker({
                  pickTime: false,
                  language: '{{ App::getLocale() }}',
                  icons: {
                      time: "fa fa-clock-o",
                      date: "fa fa-calendar",
                      up: "fa fa-arrow-up",
                      down: "fa fa-arrow-down"
                  }
              });
          });
          $( document ).ready(function()
          {
            $('#short_name').attr('maxlength', 20);
          });
     </script>
@stop