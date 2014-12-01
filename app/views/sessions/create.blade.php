@extends('layouts.template')

@section('title', trans('pagestrings.login_loginheader'))

@section('content') 

    
        {{ Form::open(['route' => 'login.store', 'class'=>'form-signin']) }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.login_loginheader') }}</h3>
            </div>
            <div class="panel-body"
                <!-- Email Field -->
                <div class="form-group">
                    {{ Form::label('email', trans('pagestrings.users_email') . ':') }}
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    {{ Form::label('password', trans('pagestrings.users_password') . ':') }}
                    {{ Form::password('password', ['class' => 'form-control']) }}
                </div>

                <!-- Login Button -->
                <div class="form-group">
                    {{ Form::submit(trans('pagestrings.login_login'), ['class' => 'btn btn-lg btn-primary btn-block']) }}
                </div>

                <div class="form-group">
                
                {{ display_alert_message() }}
            </div>
        </div>
        {{ Form::close() }}
   
    
@stop