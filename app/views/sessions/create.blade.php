@extends('layouts.template')

@section('title', 'Anmeldung')

@section('content')
    <h1>Anmeldung</h1>

    {{ Form::open(['route' => 'login.store']) }}
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

        
        {{ displayAlertMessage() }}
        

        <!-- Log In! Field -->
        <div class="form-group">
            {{ Form::submit('Anmelden', ['class' => 'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
    
@stop