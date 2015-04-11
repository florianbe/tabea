@if($hasAccess)
    <ul class="nav nav-sidebar">
        <li class="">{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</li>
        <li class="">{{ HTML::linkRoute('studies.substudies.show', trans('pagestrings.substudies_rmenu_index_d'), [$studyId, $substudyId])}}</li>
        <li class="active">{{ HTML::linkRoute('studies.substudies.questiongroups.show', trans('pagestrings.substudies_rmenu_questiongrouplink_d'), [$studyId, $substudyId, $questiongroupId])}}</li>
    </ul>
    <ul class="nav nav-sidebar">
        <li class="{{set_class('studies.substudies.questiongroups.show')}} {{set_class('studies.substudies.questiongroups.edit')}}">{{ HTML::linkRoute('studies.substudies.questiongroups.show', trans('pagestrings.questiongroups_rmenu_showlink'), [$studyId, $substudyId, $questiongroupId])}}</li>
        <li class="{{set_class('studies.substudies.questiongroups.rules.index')}} {{set_class('studies.substudies.questiongroups.rules.edit')}}">{{ HTML::linkRoute('studies.substudies.questiongroups.rules.show', trans('pagestrings.rules_rmenu_showlink'), [$studyId, $substudyId, $questiongroupId])}}</li>
    </ul>
@endif



