@extends('layouts.template')

@section('title', 'Neuer Benutzerkonto')

@section('content') 

    
        {{ Form::open(['route' => 'admin.users.store', 'class'=>'form-signin']) }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Neues Benutzerkonto</h3>
            </div>

            <div class="panel-body">

                <!-- Email Field -->
                <div class="form-group">
                    {{ Form::label('first_name', 'Vorname:') }}
                    {{ Form::text('first_name', null, ['class' => 'form-control']) }}
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    {{ Form::label('last_name', 'Nachname:') }}
                    {{ Form::text('last_name', null, ['class' => 'form-control']) }}
                </div>

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

            </div>
        </div>
        {{ Form::close() }}  
@stop