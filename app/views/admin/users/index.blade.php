@extends('layouts.template')

@section('title', 'Nutzerverwaltung|Übersicht')

@section('header', 'Nutzerverwaltung|Übersicht')

@section('sidebar')
    <li>{{ HTML::link('/admin/users', 'Übersicht')}}</li>
    <li>{{ HTML::link('/admin/users/create', 'Neuer Benutzer')}}</li>
@stop
@section('content') 
    
    {{ display_alert_message() }}

    <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th>Vorname</th>
          <th>Nachname</th>
          <th>E-Mail</th>
        </tr>
      </thead>
      <tbody>
        <h3>Nutzer</h3>
        @foreach ($users as $user)
        <tr>
          <td><a href="{{ action('UsersController@edit', array($user->id)) }}"><i class="fa fa-pencil"></i></a>&nbsp&nbsp  
          <a href="{{ action('UsersController@show', array($user->id)) }}"><i class="fa fa-list"></i></a></td>
          <td>{{ $user->first_name }}</td>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->email }}</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
      <hr/>
        <h3>Administratoren</h3>
    <ul>
        @foreach ($admins as $admin)
        <li>{{ $admin->email }}</li>
        @endforeach
    </ul>


@stop

