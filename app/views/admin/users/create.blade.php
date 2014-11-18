@extends('layouts.template')

@section('title', trans('pagestrings.users_create_header'))

@section('header', trans('pagestrings.users_create_header'))

@section('sidebar')
    @include('admin.users.sidebars.user_side')
@stop
@section('content') 

    {{ Form::open(['route' => 'admin.users.store']) }}
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.users_create_header') }}</h3>
            </div>

            <div class="panel-body">

                <!-- Name fields -->                
                {{ Bootstrap::text('first_name', trans('pagestrings.users_first_name')) }}
                {{ show_errors_for('first_name', $errors) }}

                {{ Bootstrap::text('last_name', trans('pagestrings.users_last_name')) }}
                {{ show_errors_for('last_name', $errors) }}
                
                <!-- E-Mail -->
                {{ Bootstrap::email('email', trans('pagestrings.users_email')) }}
                {{ show_errors_for('email', $errors) }}
                <!-- Set Administrative Rights -->
                <div class="checkbox form-group">
                    <label>
                        {{Form::checkbox('is_admin', '1')}} {{trans('pagestrings.users_is_admin')}}
                    </label>
                </div>

                {{ Bootstrap::submit(trans('pagestrings.users_create_create')) }}
            </div>
        </div>
        {{ Form::close() }}  
@stop