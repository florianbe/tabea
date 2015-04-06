<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ (trans('pagestrings.studies_accessdata_header', ['study_name' => $study->short_name])) }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/cosmo/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
    <!-- Custom styles for this website -->
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/bootstrap-datetimepicker.min.css') }}

</head>

<body>
    <div class="container">
        <div class="panel panel-primary col-md-10">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.studies_accessdata_panelheader') }}</h3>
            </div>
            <div class="list-group">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="row"><h4>{{ trans('pagestrings.studies_name') . ': ' . $study->name }}</h4></div>
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-4"><strong>{{trans('pagestrings.studies_accessdata_server')}}:</strong></div>
                                        <div class="col-md-8">{{ url() }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><strong>{{trans('pagestrings.studies_name_long')}}:</strong></div>
                                        <div class="col-md-8">{{ $study->short_name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><strong>{{trans('pagestrings.studies_studypassword')}}:</strong></div>
                                        <div class="col-md-8">{{ $study->studypassword }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="row"><h4>{{trans('pagestrings.studies_accessdata_qrcode')}}</h4></div>
                                <div class="row"><div id="qrcodeCanvas" ></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container -->


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
{{ HTML::script('js/jquery.qrcode.min.js') }}
<script type="text/javascript">
    $('#qrcodeCanvas').qrcode({
        size: "180",
        text: "http://tabea.dev:8080/go/2019"
    });
</script>
</html>
