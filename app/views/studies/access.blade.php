@extends('layouts.template')

@section('title', (trans('pagestrings.study_access_header', ['study_name' => $study->short_name])))

@section('header', (trans('pagestrings.study_access_header', ['study_name' => $study->name])))

@section('sidebar')
       @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
@stop
@section('content')
    {{ Form::open(['route' => ['studies.users.set', $study->id], 'method' => 'POST']) }}
    <table id ="user_access" class="table table-striped ">
      <thead>
        <tr>
          <th class="center-table">{{ trans('pagestrings.study_access_readable') }}</th>
          <th class="center-table">{{ trans('pagestrings.study_access_contributor') }}</th>
          <th>{{ trans('pagestrings.study_access_fullname') }}</th>
          <th>{{ trans('pagestrings.users_email') }}</th>
        </tr>
      </thead>
      <tbody>
            @foreach($users_to_roles as $group => $users)
                @foreach($users as $user)
                <tr>

                    <td class="center-table">{{ Bootstrap::checkbox('read[]', '', $user->id, $group == "readers" ? true : false, []) }}</td>
                    <td class="center-table">{{ Bootstrap::checkbox('contrib[]', '', $user->id, $group == "contributors" ? true : false, []) }}</td>
                    <td>{{ $user->fullName }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
            @endforeach
      </tbody>
    </table>
    <br/>
    {{ Bootstrap::submit(trans('pagestrings.study_access_set'))  }}
    {{ Form::close() }}
    <br/>
      <hr/>

@stop


@section('javascript')
    <script type="text/javascript">
          $(document).ready(function() {
                  $('#user_access').dataTable( {
                      "language": {
                          "url": "{{ Config::get('app.datatableslocale') }}"
                      }
                  } );
              } );

     </script>
@stop

