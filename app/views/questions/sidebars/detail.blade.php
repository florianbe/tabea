@if($hasAccess)
    <ul class="nav nav-sidebar">
        <li class="">{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</li>
        <li class="">{{ HTML::linkRoute('studies.substudies.show', trans('pagestrings.substudies_rmenu_index_d'), [$studyId, $substudyId])}}</li>
        <li class="">{{ HTML::linkRoute('studies.substudies.questiongroups.show', trans('pagestrings.substudies_rmenu_questiongrouplink_d'), [$studyId, $substudyId, $questiongroupId])}}</li>
        <li class="active">{{ HTML::linkRoute('studies.substudies.questiongroups.questions.show', trans('pagestrings.substudies_rmenu_questionlink'), [$studyId, $substudyId, $questiongroupId, $questionId])}}</li>
    </ul>
    <ul class="nav nav-sidebar">
        <li class="active">{{ HTML::linkRoute('studies.substudies.questiongroups.questions.show', trans('pagestrings.substudies_rmenu_question'), [$studyId, $substudyId, $questiongroupId, $questionId])}}</li>
    </ul>
@endif



