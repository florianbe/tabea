<ul class="nav nav-sidebar">
        <li>{{ HTML::linkRoute('studies.index', trans('pagestrings.studies_rmenu_indexlink'))}}</li>
        <li class="{{set_class('studies.my')}}">{{ HTML::linkRoute('studies.my', trans('pagestrings.studies_rmenu_mystudieslink'))}}</li>
</ul>
<h3 class="{{set_class('studies.show')}}">{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</h3>
@if($hasAccess)

<ul class="nav nav-sidebar">
        <li class="{{set_class('studies.show')}}">{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_rmenu_studyshow'), [$studyId])}}</li>
        <li class="{{set_class('studies.edit')}}">{{ HTML::linkRoute('studies.edit', trans('pagestrings.studies_rmenu_studyedit'), [$studyId])}}</li>
        <li class="{{set_class('studies.users.view')}}">{{ HTML::linkRoute('studies.users.view', trans('pagestrings.studies_rmenu_access'), [$studyId])}}</li>
        <li class="{{set_class('studies.requests') . set_class('requests.edit')}}">{{ HTML::linkRoute('studies.requests', trans('pagestrings.studies_rmenu_requests'), [$studyId])}}</li>
</ul>
<h3>{{ HTML::linkRoute('studies.substudies.index', trans('pagestrings.substudies_rmenu_index'), [$studyId])}}</h3>
@else
<ul class="nav nav-sidebar">
        <li class="{{set_class('requests.new')}}">{{ HTML::linkRoute('requests.new', trans('pagestrings.study_show_request_access'), [$studyId]) }}</li>
</ul>
@endif

