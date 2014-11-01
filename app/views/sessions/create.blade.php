@extends('layouts.template')

@section('title', 'Anmeldung')

@section('content') 

    
        {{ Form::open(['route' => 'login.store', 'class'=>'form-signin']) }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Anmeldung</h3>
            </div>
            <div class="panel-body"
                <!-- Email Field -->
                <div class="form-group">
                    {{ Form::label('email', 'Email:') }}
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    {{ Form::label('password', 'Passwort:') }}
                    {{ Form::password('password', ['class' => 'form-control']) }}
                </div>

                <!-- Login Button -->
                <div class="form-group">
                    {{ Form::submit('Anmelden', ['class' => 'btn btn-lg btn-primary btn-block']) }}
                </div>

                <div class="form-group">
                
                {{ display_alert_message() }}
            </div>
        </div>
        {{ Form::close() }}
   
    
@stop