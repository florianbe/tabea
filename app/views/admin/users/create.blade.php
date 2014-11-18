@extends('layouts.template')

@section('title', 'Neues Benutzerkonto anlegen')

@section('header', 'Neuer Benutzer')

@section('sidebar')
    <li>{{ HTML::link('/admin/users', 'Übersicht')}}</li>
@stop
@section('content') 

    {{ Form::open(['route' => 'admin.users.store']) }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Neues Benutzerkonto anlegen</h3>
            </div>

            <div class="panel-body">

                <!-- Name fields -->                
                {{ Bootstrap::text('first_name', 'Vorname') }}
                {{ show_errors_for('first_name', $errors) }}

                {{ Bootstrap::text('last_name', 'Nachname') }}
                {{ show_errors_for('last_name', $errors) }}
                
                <!-- E-Mail -->
                {{ Bootstrap::email('email', 'E-Mail Adresse') }}
                {{ show_errors_for('email', $errors) }}
                <!-- Set Administrative Rights -->
                <div class="checkbox form-group">
                    <label>
                        {{Form::checkbox('is_admin', '1')}} Administrator
                    </label>
                </div>

                {{ Bootstrap::submit('Erstellen') }}
            </div>
        </div>
        {{ Form::close() }}  
@stop