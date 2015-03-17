@if($hasAccess)
    <h3>{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</h3>
    <h3>{{ HTML::linkRoute('studies.substudies.show', trans('pagestrings.substudies_rmenu_substudy'), [$studyId, $substudyId])}}</h3>
    <h3>{{ HTML::linkRoute('studies.substudies.questiongroups.index', trans('pagestrings.substudies_rmenu_questiongrouplink'), [$studyId, $substudyId])}}</h3>
    <ul class="nav nav-sidebar">
        <li class="{{set_class('studies.substudies.questiongroups.index')}}">{{ HTML::linkRoute('studies.substudies.questiongroups.index', trans('pagestrings.substudies_rmenu_questiongrouplinkind'), [$studyId, $substudyId])}}</li>
        <li class="{{set_class('studies.substudies.questiongroups.show')}}">{{ HTML::linkRoute('studies.substudies.questiongroups.show', trans('pagestrings.questiongroups_rmenu_showlink'), [$studyId, $substudyId, $questiongroupId])}}</li>
        <li class="{{set_class('studies.substudies.questiongroups.edit')}}">{{ HTML::linkRoute('studies.substudies.questiongroups.edit', trans('pagestrings.questiongroups_rmenu_editlink'), [$studyId, $substudyId, $questiongroupId])}}</li>
    </ul>
@endif

