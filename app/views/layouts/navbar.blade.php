    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
           <a class="navbar-brand">TaBEA</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">       
            <li><a href="{{ route('home') }}">{{ trans('pagestrings.top_menu_home') }}</a></li>
            <li><a href="{{ route('studies.my') }}">{{ trans('pagestrings.top_menu_studies') }}</a></li>
            <li><a href="{{ route('requests.index') }}">{{ trans('pagestrings.top_menu_requests') }}</a></li>
            </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::user()->is_admin)
            <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-users fa-lg"></i>  {{ trans('pagestrings.top_menu_users') }}</a></li>
            @endif
            <li><a href="{{ route('profile.show') }}"><i class="fa fa-user fa-lg"></i>  {{ trans('pagestrings.top_menu_profile') }}</a></li>
            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-lg"></i>  {{ trans('pagestrings.top_menu_logout') }}</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>