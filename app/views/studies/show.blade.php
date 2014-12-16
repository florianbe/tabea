@extends('layouts.template')

@section('title', (trans('pagestrings.studies_detail_header', ['study_name' => $study->short_name])))

@section('header', (trans('pagestrings.studies_detail_header', ['study_name' => $study->name])))

@section('sidebar')
    @include('studies.sidebars.detail', ['studyId' => $study->id, 'hasAccess' => Auth::user()->hasAccessToStudy($study), 'canContribute' => (Auth::user()->isAdmin || $study->contributors->contains(Auth::user()))])
@stop
@section('content') 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('pagestrings.studies_create_panelheader') }}</h3>
            </div>
            <div class="list-group">
                <div class="list-group-item">
                    <div class="list-group-item">
                        <div class="row">
                          <div class="col-md-4"><strong>{{trans('pagestrings.studies_state')}}:</strong></div>
                          <div class="col-md-8">{{ $study->studystate->name }}</div>
                        </div>
                        <div class="row">
                          <div class="col-md-4"><strong>{{trans('pagestrings.studies_name_short')}}:</strong></div>
                          <div class="col-md-8">{{$study->short_name}}</div>
                        </div>
                        <div class="row">
                          <div class="col-md-4"><strong>{{trans('pagestrings.studies_author')}}:</strong></div>
                          <div class="col-md-8">{{$study->author->full_name}}</div>
                        </div>
                        <div class="row">
                          <div class="col-md-4"><strong>{{trans('pagestrings.studies_studypassword')}}:</strong></div>
                          <div class="col-md-8">{{$study->studypassword}}</div>
                        </div>
                        <div class="row">
                          <div class="col-md-4"><strong>{{trans('pagestrings.studies_accessible_from_label')}}:</strong></div>
                          <div class="col-md-8">{{ format_date_to_display($study->accessible_from)}}</div>
                        </div>
                        <div class="row">
                          <div class="col-md-4"><strong>{{trans('pagestrings.studies_accessible_until_label')}}:</strong></div>
                          <div class="col-md-8">{{format_date_to_display($study->accessible_until)}}</div>
                        </div>
                        <div class="row">
                          <div class="col-md-4"><strong>{{trans('pagestrings.studies_uploadable_until_label')}}:</strong></div>
                          <div class="col-md-8">{{format_date_to_display($study->uploadable_until)}}</div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <h4 class="list-group-item-heading">{{trans('pagestrings.studies_comment')}}:</h4>
                    <div class="list-group-item-text">
                    <p>{{$study->studies_comment}}</p>
                    </div>
                </div>
                <div class="list-group-item">
                    <h4 class="list-group-item-heading">{{trans('pagestrings.studies_description')}}:</h4>
                    <div class="list-group-item-text">
                    <p>{{$study->description}}</p>
                    </div>
                </div>
            </div>
        </div>
@stop