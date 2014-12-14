<ul class="nav nav-sidebar">
        <li>{{ HTML::linkRoute('studies.index', trans('pagestrings.studies_rmenu_indexlink'))}}</li>
        <li class="active">{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</li>
</ul>

@if($hasAccess)
<ul class="nav nav-sidebar">
        <li class="{{set_class('studies.edit')}}">{{ HTML::linkRoute('studies.edit', trans('pagestrings.studies_rmenu_studyedit'), [$studyId])}}</li>
        <li class="{{set_class('studies.users.view')}}">{{ HTML::linkRoute('studies.users.view', trans('pagestrings.studies_rmenu_access'), [$studyId])}}</li>
        <li class="{{set_class('studies.substudy.index')}}">{{ HTML::linkRoute('studies.substudies.index', trans('pagestrings.substudies_rmenu_index'), [$studyId])}}</li>
</ul>
@else
<ul class="nav nav-sidebar">
        <li class="{{set_class('requests.new')}}">{{ HTML::linkRoute('requests.new', trans('pagestrings.study_show_request_access'), [$studyId]) }}</li>
</ul>
@endif