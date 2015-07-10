@extends('layouts.template')

@section('content')
<div class="starter-template">
    <h1>
        {{ trans('pagestrings.hello', ['full_name' => Auth::user()->full_name]) }}
    </h1>
    <p class="lead">{{trans('pagestrings.welcome')}}</p>
</div>
@stop