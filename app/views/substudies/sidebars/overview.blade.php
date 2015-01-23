@if($hasAccess)
    <h3>{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</h3>
    <h3>{{ HTML::linkRoute('studies.substudies.index', trans('pagestrings.substudies_rmenu_index'), [$studyId])}}</h3>
    <ul class="nav nav-sidebar">
        <li class="{{set_class('studies.substudies.index')}}">{{ HTML::linkRoute('studies.substudies.index', trans('pagestrings.substudies_rmenu_indexlink'), [$studyId])}}</li>
        <li class="{{set_class('studies.substudies.create')}}">{{ HTML::linkRoute('studies.substudies.create', trans('pagestrings.substudies_rmenu_createlink'), [$studyId])}}</li>
    </ul>
@endif