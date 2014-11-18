<ul class="nav nav-sidebar">
    <li class="{{set_class('study.index')}}">{{ HTML::linkRoute('study.index', trans('pagestrings.studies_rmenu_indexlink'))}}</li>
    <li class="{{set_class('study.my')}}">{{ HTML::linkRoute('study.my', trans('pagestrings.studies_rmenu_mystudieslink'))}}</li>
    <li class="{{set_class('study.create')}}">{{ HTML::linkRoute('study.create', trans('pagestrings.studies_rmenu_createlink'))}}</li>
</ul>