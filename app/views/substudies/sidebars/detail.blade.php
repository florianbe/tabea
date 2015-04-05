<ul class="nav nav-sidebar">
    <li class="">{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</li>
    <li class="active">{{ HTML::linkRoute('studies.substudies.show', trans('pagestrings.substudies_rmenu_index_d'), [$studyId, $substudyId])}}</li>
</ul>
@if($hasAccess)
    <ul class="nav nav-sidebar">
        <li class="{{set_class('studies.substudies.show')}} {{set_class('studies.substudies.edit')}}">{{ HTML::linkRoute('studies.substudies.show', trans('pagestrings.substudies_rmenu_showlink'), [$studyId, $substudyId])}}</li>
        <li class="{{set_class('studies.substudies.questiongroups.index')}}">{{HTML::linkRoute('studies.substudies.questiongroups.index', trans('pagestrings.substudies_rmenu_questiongrouplink'), [$studyId, $substudyId])}}</li>
    </ul>
@endif





