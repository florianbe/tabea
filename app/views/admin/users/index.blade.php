@extends('layouts.template')

@section('title', 'Nutzerverwaltung|Übersicht')

@section('header', 'Nutzerverwaltung|Übersicht')

@section('sidebar')
    <li>{{ HTML::link('/admin/users', 'Übersicht')}}</li>
    <li>{{ HTML::link('/admin/users/create', 'Neuer Benutzer')}}</li>
@stop
@section('content') 

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Vorname</th>
          <th>Nachname</th>
          <th>E-Mail</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td>{{ $user->first_name }}</td>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->email }}</td>
          <td>editlink</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <ul>
        @foreach ($admins as $admin)
        <li>{{ $admin->email }}</li>
        @endforeach
    </ul>


@stop

