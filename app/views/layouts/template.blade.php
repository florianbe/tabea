
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'TaBEA')</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/cosmo/bootstrap.min.css" >
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
    <!-- Custom styles for this website -->
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/bootstrap-datetimepicker.min.css') }}

  </head>

  <body>
    @if (Auth::check())
      @include('layouts.navbar')
      
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          @yield('sidebar')
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">@yield('header')</h1>
            {{ display_alert_message() }}
            @yield('content')

        </div>
      </div>
    </div>

 
    @else
      <div class="container">
        @yield('content')        
      </div><!-- /.container -->
    @endif

     <div class="container">
        @yield('footer')
     </div>

    
  </body>
    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <!-- Local JavaScript files -->
    {{ HTML::script('js/moment-with-locales.js') }}
    {{ HTML::script('js/bootstrap-datetimepicker.min.js') }}
    @yield('javascript')
</html>
