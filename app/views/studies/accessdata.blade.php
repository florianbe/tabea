@extends('layouts.template')

@section('title', (trans('pagestrings.studies_accessdata_header', ['study_name' => $study->short_name])))

@section('header', (trans('pagestrings.studies_accessdata_header', ['study_name' => $study->name])))

@section('sidebar')
    @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
@stop
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('pagestrings.studies_accessdata_panelheader') }}</h3>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <div class="row">
                    <div class="col-md-8">
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

                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="row"><h4>{{trans('pagestrings.studies_accessdata_qrcode')}}</h4></div>
                            <div class="row"><div id="qrcodeCanvas" ></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            {{ HTML::linkRoute('studies.access.p', trans('pagestrings.studies_accessdata_linktoprint'), [$study->id], ['target' => '_blank']) }}
        </div>
    </div>

@stop

@section('javascript')
    {{ HTML::script('js/jquery.qrcode.min.js') }}
    <script type="text/javascript">
        $('#qrcodeCanvas').qrcode({
            size: "180",
            text: "http://tabea.dev:8080/go/2019"
        });
    </script>
@stop
