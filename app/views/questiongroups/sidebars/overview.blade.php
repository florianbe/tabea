@if($hasAccess)
    <h3>{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</h3>
    <h3>{{ HTML::linkRoute('studies.substudies.show', trans('pagestrings.substudies_rmenu_substudy'), [$studyId, $substudyId])}}</h3>
    <ul class="nav nav-sidebar">
        <li class="{{set_class('studies.substudies.questiongroup.index')}}">{{ HTML::linkRoute('studies.substudies.questiongroup.index', trans('pagestrings.substudies_rmenu_questiongrouplinkind'), [$studyId, $substudyId])}}</li>
        <li class="{{set_class('studies.substudies.questiongroup.create')}}">{{ HTML::linkRoute('studies.substudies.questiongroup.create', trans('pagestrings.substudies_rmenu_questiongrouplinknew'), [$studyId, $substudyId])}}</li>
    </ul>
@endif
