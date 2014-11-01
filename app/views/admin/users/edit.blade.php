@extends('layouts.template')

@section('title', 'Neues Benutzerkonto anlegen')

@section('header', 'Neuer Benutzer')

@section('sidebar')
    <li>{{ HTML::link('/admin/users', 'Übersicht')}}</li>
@stop
@section('content') 

     <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Benutzerkonto bearbeiten</h3>
            </div>
            <div class="panel-body">
            {{ Form::open(['route' => 'admin.users.update']) }}
                <!-- Name fields -->                
                {{ Bootstrap::text('first_name', 'Vorname', $user->first_name) }}
                {{ Bootstrap::text('last_name', 'Nachname', $user->last_name) }}

                <!-- E-Mail -->
                {{ Bootstrap::email('email', 'E-Mail Adresse', $user->email) }}

                <!-- Set Administrative Rights -->
                <div class="checkbox form-group">
                    <label>
                        {{Form::checkbox('is_admin', '1')}} Administrator
                    </label>
                </div>

                {{ Bootstrap::submit('Änderungen speichern') }}
            {{ Form::close() }}  
            {{ Form::}}
            </div>
        </div>
 
@stop