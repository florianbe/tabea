@if($hasAccess)
    <ul class="nav nav-sidebar">
        <li class="{{set_class('studies.substudies.index')}}">{{ HTML::linkRoute('studies.substudies.index', trans('pagestrings.substudies_rmenu_indexlink'), [$studyId])}}</li>
        <li class="{{set_class('studies.substudies.show')}}">{{ HTML::linkRoute('studies.substudies.show', trans('pagestrings.substudies_rmenu_showlink'), [$studyId, $substudyId])}}</li>
        <li class="{{set_class('studies.substudies.edit')}}">{{ HTML::linkRoute('studies.substudies.edit', trans('pagestrings.substudies_rmenu_editlink'), [$studyId, $substudyId])}}</li>
    </ul>
    <h3>{{HTML::linkRoute('studies.substudies.questiongroup.index', trans('pagestrings.substudies_rmenu_questiongrouplink'), [$studyId, $substudyId])}}</h3>
@endif
