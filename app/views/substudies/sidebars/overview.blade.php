@if($hasAccess)
    <ul class="nav nav-sidebar">
        <li class="{{set_class('studies.substudies.index')}}">{{ HTML::linkRoute('studies.substudies.index', trans('pagestrings.studies_rmenu_indexlink'), [$studyId])}}</li>
        <li class="{{set_class('studies.substudies.create')}}">{{ HTML::linkRoute('studies.substudies.create', trans('pagestrings.studies_rmenu_createlink'), [$studyId])}}</li>
    </ul>
@endif