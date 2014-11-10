@extends('layouts.template')

@section('title', trans('pagestrings.users_edit_header'))
@stop

@section('header', trans('pagestrings.users_edit_header'))
@stop

@section('sidebar')
    <li>{{ HTML::link('/admin/users/create', trans('pagestrings.users_rmenu_createlink'))}}</li>
    <li>{{ HTML::link('/admin/users', trans('pagestrings.users_rmenu_indexlink'))}}</li>
@stop
@section('content')
    <div class="row">
    {{ Form::model($user, ['method' => 'PATCH', 'route' => ['admin.users.update', $user->id]]) }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.users_edit_header') }}</h3>
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
                @if($user->is_admin == false)
                <!-- Set Administrative Rights -->
                <div class="checkbox form-group">
                    <label>
                        {{Form::checkbox('is_admin', '1')}} Administrator
                    </label>
                </div>
                @endif
                {{ Bootstrap::submit('Aktualisieren') }}
            </div>
        </div>
        {{ Form::close() }}
        {{ Form::model($user, ['method' => 'DELETE', 'route' => ['admin.users.destroy', $user->id]]) }}
            {{ Bootstrap::submit(trans('pagestrings.users_edit_delete')) }}
        {{ Form::close() }}
        </div>
@stop