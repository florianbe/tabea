@extends('layouts.template')

@section('title', trans('pagestrings.users_index_header'))

@section('header', trans('pagestrings.users_index_header'))

@section('sidebar')
    @include('admin.users.sidebars.user_side')
@stop
@section('content') 
    
    <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th>{{ trans('pagestrings.users_first_name') }}</th>
          <th>{{ trans('pagestrings.users_last_name') }}</th>
          <th>{{ trans('pagestrings.users_email') }}</th>
        </tr>
      </thead>
      <tbody>
        <h3></h3>
        @foreach ($users as $user)
        <tr>
          <td><a href="{{ action('UsersController@edit', [$user->id]) }}"><i class="fa fa-pencil"></i></a>&nbsp&nbsp
          <a href="{{ action('UsersController@show', [$user->id]) }}"><i class="fa fa-list"></i></a></td>
          <td>{{ $user->first_name }}</td>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->email }}</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
      <hr/>
        <h3>{{ trans('pagestrings.users_index_admins') }}</h3>
    <ul>
        @foreach ($admins as $admin)
        <li><a href="mailto:{{ $admin->email }}">{{$admin->full_name . ": " .$admin->email}}</a></li>
        @endforeach
    </ul>


@stop

