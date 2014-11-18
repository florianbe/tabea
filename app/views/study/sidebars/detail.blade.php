<ul class="nav nav-sidebar">
        <li class="{{set_class('study.index')}}">{{ HTML::linkRoute('study.index', trans('pagestrings.studies_rmenu_indexlink'))}}</li>
        <li class="{{set_class('study.show')}}">{{ HTML::linkRoute('study.show', trans('pagestrings.studies_name'), [$study])}}</li>
</ul>

<ul class="nav nav-sidebar">
        <li class="{{set_class('study.edit')}}">{{ HTML::linkRoute('study.edit', trans('pagestrings.studies_rmenu_studyedit'), [$study])}}</li>
        <li class="{{set_class('study.substudy.index')}}">{{ HTML::linkRoute('study.substudy.index', trans('pagestrings.substudies_rmenu_index'), [$study])}}</li>
</ul>