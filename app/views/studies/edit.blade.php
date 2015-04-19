@extends('layouts.template')

@section('title', (trans('pagestrings.studies_detail_header', ['study_name' => $study->short_name])))

@section('header', (trans('pagestrings.studies_detail_header', ['study_name' => $study->name])))

@section('sidebar')
    @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => $study->hasEditAccess(Auth::user())])
@stop
@section('content')

    {{ Form::model($study, ['route' => ['studies.update', $study->id], 'method' => 'PUT']) }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.studies_create_panelheader') }}</h3>
            </div>

            <div class="panel-body">

                <!-- Name fields -->
                {{ Bootstrap::text('name', trans('pagestrings.studies_name_long'), $study->name, [], [$study->isStudyEditable() ? '' : 'disabled']) }}
                {{ show_errors_for('name', $errors) }}

                {{ Bootstrap::text('short_name', trans('pagestrings.studies_name_short'), $study->short_name, [], [$study->isStudyEditable() ? '' : 'disabled']) }}
                {{ show_errors_for('short_name', $errors) }}

                 {{ Bootstrap::text('studypassword', trans('pagestrings.studies_studypassword'), $study->studypassword, [], [$study->isStudyEditable() ? '' : 'disabled']) }}
                 {{ show_errors_for('studypassword', $errors) }}

                {{ Bootstrap::textarea('description', trans('pagestrings.studies_description'), $study->description, [], [$study->isStudyEditable() ? '' : 'disabled', 'rows' => '4'] ) }}
                {{ show_errors_for('description', $errors) }}

                {{ Bootstrap::textarea('comment', trans('pagestrings.studies_comment'), $study->comment, [], [$study->isStudyEditable() ? '' : 'disabled', 'rows' => '4']) }}
                {{ show_errors_for('comment', $errors) }}

                <div class="form-group">
                <label for="accessible_from" class="control-label ">{{ trans('pagestrings.studies_accessible_from_label') }}</label>
                    <div id="date_accessible_from" class="input-group date datepicker">
                        <input  class="form-control" name="accessible_from" type="text" id="accessible_from" {{ date_for_picker($study->accessible_from) }} {{$study->isStudyEditable() ? '' : 'disabled'}} />
                        <span class="input-group-addon"><span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
                {{ show_errors_for('accessible_from', $errors) }}

                <div class="form-group">
                <label for="accessible_until" class="control-label ">{{ trans('pagestrings.studies_accessible_until_label') }}</label>
                    <div id="date_accessible_until" class="input-group date datepicker">
                        <input class="form-control" name="accessible_until" type="text" id="accessible_until" {{ date_for_picker($study->accessible_until) }} {{$study->isStudyEditable() ? '' : 'disabled'}} />
                        <span class="input-group-addon"><span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
                {{ show_errors_for('accessible_until', $errors) }}

                <div class="form-group">
                    <label for="uploadable_until" class="control-label ">{{ trans('pagestrings.studies_uploadable_until_label') }}</label>
                    <div id="date_accessible_from" class="input-group date datepicker">
                        <input class="form-control" name="uploadable_until" type="text" id="uploadable_until" {{ date_for_picker($study->uploadable_until) }} {{$study->isStudyEditable() ? '' : 'disabled'}} />
                        <span class="input-group-addon"><span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
                {{ show_errors_for('uploadable_until', $errors) }}

                {{ Bootstrap::select('studystate', trans('pagestrings.studies_state'), $study->getStudystateOptions(), $study->studystate->code, [], [$study->isStateEditable() ? '' : 'disabled']) }}

            </div>
        </div>
    @if (Session::has('object_validation'))
        <div class="alert alert-danger" role="alert">{{Session::get('object_validation')}}</div>
    @endif

        <div class="list-group-item">
            <div class="list-group-item-text">
                <div class="row">
                    <div class="col-md-6 text-left"><a class="btn btn-primary btn-back" >{{ trans('pagestrings.back') }}</a></div>
                    <div class="col-md-6 text-right">{{ Bootstrap::submit(trans('pagestrings.studies_create_savebutton')) }}</div>
                </div>
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
    {{ HTML::script('js/tabea.js') }}
@stop