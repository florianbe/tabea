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
                {{ Bootstrap::text('last_name', 'Nachname') }}

                <!-- E-Mail -->
                {{ Bootstrap::email('email', 'E-Mail Adresse') }}

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