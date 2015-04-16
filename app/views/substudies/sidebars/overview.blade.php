@if($hasAccess)
    <ul class="nav nav-sidebar">
        <li class="">{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</li>
        <li class="active">{{ HTML::linkRoute('studies.substudies.index', trans('pagestrings.substudies_rmenu_index'), [$studyId])}}</li>
    </ul>
    <ul class="nav nav-sidebar">
        <li class="{{set_class('studies.substudies.index')}}">{{ HTML::linkRoute('studies.substudies.index', trans('pagestrings.substudies_rmenu_indexlink'), [$studyId])}}</li>
        @if($study_editable && $canContribute)
        <li class="{{set_class('studies.substudies.create')}}">{{ HTML::linkRoute('studies.substudies.create', trans('pagestrings.substudies_rmenu_createlink'), [$studyId])}}</li>
        @endif
    </ul>
@endif