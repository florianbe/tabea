<ul class="nav nav-sidebar">
        <li>{{ HTML::linkRoute('study.index', trans('pagestrings.studies_rmenu_indexlink'))}}</li>
        <li class="active">{{ HTML::linkRoute('study.show', trans('pagestrings.studies_name'), [$studyId])}}</li>
</ul>

<ul class="nav nav-sidebar">
        <li class="{{set_class('study.edit')}}">{{ HTML::linkRoute('study.edit', trans('pagestrings.studies_rmenu_studyedit'), [$studyId])}}</li>
        <li class="{{set_class('study.substudy.index')}}">{{ HTML::linkRoute('study.substudy.index', trans('pagestrings.substudies_rmenu_index'), [$studyId])}}</li>
</ul>