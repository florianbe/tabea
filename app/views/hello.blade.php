@extends('layouts.template')

@section('content')
<div class="starter-template">
    <h1>
        {{ trans('pagestrings.hello', ['full_name' => Auth::user()->full_name]) }}
    </h1>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi architecto commodi ea ex, itaque maxime nihil omnis rem. A aliquam, consequuntur delectus dolorem doloribus eligendi nemo officia rerum sequi unde!</p>
</div>
@stop