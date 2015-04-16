@if($hasAccess)
<ul class="nav nav-sidebar">
    <li class="">{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</li>
    <li class="">{{ HTML::linkRoute('studies.substudies.show', trans('pagestrings.substudies_rmenu_index_d'), [$studyId, $substudyId])}}</li>
    <li class="active">{{ HTML::linkRoute('studies.substudies.questiongroups.index', trans('pagestrings.substudies_rmenu_questiongrouplink'), [$studyId, $substudyId])}}</li>
</ul>
<ul class="nav nav-sidebar">
    <li class="{{set_class('studies.substudies.questiongroups.index')}} {{set_class('studies.substudies.questionsgroups.editorder')}}">{{ HTML::linkRoute('studies.substudies.questiongroups.index', trans('pagestrings.substudies_rmenu_questiongrouplinkind'), [$studyId, $substudyId])}}</li>
   @if($study_editable && $canContribute)
    <li class="{{set_class('studies.substudies.questiongroups.create')}}">{{ HTML::linkRoute('studies.substudies.questiongroups.create', trans('pagestrings.substudies_rmenu_questiongrouplinknew'), [$studyId, $substudyId])}}</li>
   @endif
</ul>
@endif


