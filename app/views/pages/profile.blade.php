@extends('layouts.template')

@section('title', trans('pagestrings.profile_header'))
@stop


@section('content')
    <div class="row">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.panel_header') }}</h3>
            </div>

            <div class="panel-body">
                {{ Form::model(Auth::user(), ['method' => 'PATCH', 'route' => 'profile.update']) }}
                <!-- Password fields -->
                {{ Bootstrap::password('password', trans('pagestrings.profile_password')) }}
                {{ show_errors_for('password', $errors) }}

                {{ Bootstrap::password('password_confirmation', trans('pagestrings.profile_password_verify')) }}
                {{ show_errors_for('password_confirmation', $errors) }}


                {{ Bootstrap::submit(trans('pagestrings.profile_save')) }}
                {{ Form::close() }}
         </div>
         </div>
    </div>
@stop

@section('javascript')

@stop
