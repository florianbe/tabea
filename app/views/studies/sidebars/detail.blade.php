<ul class="nav nav-sidebar">
        <li class="active">{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_name'), [$studyId])}}</li>
</ul>


<ul class="nav nav-sidebar">
        <li class="{{set_class('studies.show')}} {{set_class('studies.edit')}}">{{ HTML::linkRoute('studies.show', trans('pagestrings.studies_rmenu_studyshow'), [$studyId])}}</li>
@if($hasAccess)
        <li class="{{set_class('studies.results')}}">{{ HTML::linkRoute('studies.results', trans('pagestrings.studies_rmenu_studyresults'), [$studyId]) }}</li>
        <li class="{{set_class('studies.access')}}">{{ HTML::linkRoute('studies.access', trans('pagestrings.studies_rmenu_studyaccess'), [$studyId])}}</li>
        @if($canContribute)
        <li class="{{set_class('studies.users.view')}}">{{ HTML::linkRoute('studies.users.view', trans('pagestrings.studies_rmenu_access'), [$studyId])}}</li>
        <li class="{{set_class('studies.requests') . set_class('requests.edit')}}">{{ HTML::linkRoute('studies.requests', trans('pagestrings.studies_rmenu_requests'), [$studyId])}}</li>
        @endif
        <li class="{{set_class('studies.substudies.index')}}">{{ HTML::linkRoute('studies.substudies.index', trans('pagestrings.substudies_rmenu_index'), [$studyId])}}</li>
@endif
</ul>
@if(!$hasAccess)
<ul class="nav nav-sidebar">
        <li class="{{set_class('requests.new')}}">{{ HTML::linkRoute('requests.new', trans('pagestrings.study_show_request_access'), [$studyId]) }}</li>
</ul>
@endif

