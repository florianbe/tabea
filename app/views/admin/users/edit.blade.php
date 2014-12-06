@extends('layouts.template')

@section('title', trans('pagestrings.profile_header'))
@stop

@section('header', trans('pagestrings.users_edit_header'))
@stop

@section('sidebar')
    @include('admin.users.sidebars.user_side')
    <ul class="nav nav-sidebar">
        <li class="active">{{ HTML::linkRoute('admin.users.edit', trans('pagestrings.users_edit_header'), ['user' => $user->id])}}</li>
    </ul>
@stop
@section('content')
    <div class="row">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.users_edit_header') }}</h3>
            </div>

            <div class="panel-body">
                {{ Form::model($user, ['method' => 'PATCH', 'route' => ['admin.users.update', $user->id]]) }}
                <!-- Name fields -->                
                {{ Bootstrap::text('first_name', trans('pagestrings.users_first_name')) }}
                {{ show_errors_for('first_name', $errors) }}

                {{ Bootstrap::text('last_name', trans('pagestrings.users_last_name')) }}
                {{ show_errors_for('last_name', $errors) }}
                
                <!-- E-Mail -->
                {{ Bootstrap::email('email', trans('pagestrings.users_email')) }}
                {{ show_errors_for('email', $errors) }}
                @if($user->is_admin == false)
                <!-- Set Administrative Rights -->
                <div class="checkbox form-group">
                    <label>
                        {{Form::checkbox('is_admin', '1')}} {{ trans('pagestrings.users_is_admin') }}
                    </label>
                </div>
                @endif
                {{ Bootstrap::submit(trans('pagestrings.users_edit_save')) }}
                {{ Form::close() }}

                </div>
         </div>
         </div>



        <div class="row">
            <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.users_edit_reset_password') }}</h3>
                </div>
                <div class="panel-body">
                <div class="col-md-6 col-md-offset-3">
                {{ Form::model($user, ['method' => 'PATCH', 'route' => ['admin.users.resend', $user->id]]) }}
                {{ Bootstrap::submit(trans('pagestrings.users_edit_reset_password'),['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
                </div>
                </div>
                </div>
            </div>
            <div class="col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.users_edit_delete') }}</h3>
                </div>
                <div class="panel-body">
                <div class="col-md-6 col-md-offset-3">
                {{ Form::model($user, ['method' => 'DELETE', 'route' => ['admin.users.destroy', $user->id]]) }}
                {{ Bootstrap::submit(trans('pagestrings.users_edit_delete'), ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
                </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

@stop
