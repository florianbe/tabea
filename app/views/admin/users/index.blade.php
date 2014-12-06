@extends('layouts.template')

@section('title', trans('pagestrings.users_index_header'))

@section('header', trans('pagestrings.users_index_header'))

@section('sidebar')
    @include('admin.users.sidebars.user_side')
@stop
@section('content') 
    
    <table id="users" class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th>{{ trans('pagestrings.users_last_name') }}</th>
          <th>{{ trans('pagestrings.users_first_name') }}</th>
          <th>{{ trans('pagestrings.users_email') }}</th>
        </tr>
      </thead>
      <tbody>
        <h3></h3>
        @foreach ($users as $user)
        <tr>
          <td><a href="{{ action('UsersController@edit', [$user->id]) }}"><i class="fa fa-pencil"></i></a>&nbsp&nbsp
          <a href="{{ action('UsersController@show', [$user->id]) }}"><i class="fa fa-list"></i></a></td>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->first_name }}</td>
          <td><a href={{ $user->email }}>{{ $user->email }}</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
      <hr/>
        <h3><br/>{{ trans('pagestrings.users_index_admins') }}</h3>
        <table class="table table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>{{ trans('pagestrings.users_last_name') }}</th>
                  <th>{{ trans('pagestrings.users_first_name') }}</th>
                  <th>{{ trans('pagestrings.users_email') }}</th>
                </tr>
              </thead>
              <tbody>
                <h3></h3>
                @foreach ($admins as $admin)
                <tr>
                  <td><a href="{{ action('UsersController@edit', [$admin->id]) }}"><i class="fa fa-pencil"></i></a>&nbsp&nbsp
                  <a href="{{ action('UsersController@show', [$admin->id]) }}"><i class="fa fa-list"></i></a></td>
                  <td>{{ $admin->last_name }}</td>
                  <td>{{ $admin->first_name }}</td>
                  <td><a href={{ $admin->email }}>{{ $admin->email }}</a></td>
                </tr>
                @endforeach
              </tbody>
        </table>
    </ul>


@stop

@section('javascript')
    <script type="text/javascript">
          $(document).ready(function() {
                  $('#users').dataTable( {
                      "language": {
                          "url": "{{ Config::get('app.datatableslocale') }}"
                      }
                  } );
              } );

     </script>
@stop

