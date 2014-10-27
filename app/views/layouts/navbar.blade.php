    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
           <a class="navbar-brand">TaBEA</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">       
            <li><a href="{{ route('home') }}">Home</a></li>
            @if (Auth::user()->is_admin)
            <li><a href="{{ route('users') }}">Nutzerverwaltung</a></li>
            @endif
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-lg"></i>  Abmelden</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>