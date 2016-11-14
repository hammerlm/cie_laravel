@extends('templateslvlone.templateslvltwo.templateslvlthree.master')
@section('leftcol_content')
    <ul class="nav nav-pills nav-stacked">
        @can('manage-news')
            <li @if($selectedmenuitem_v == "News") class="active" @endif role="presentation"><a href="/backend/news">News</a></li>
        @endcan
        @can('manage-gamedays')
        <li @if($selectedmenuitem_v == "Gamedays") class="active" @endif role="presentation"><a href="/backend/gamedays">Eisterminverwaltung</a></li>
        @endcan
        @can('authenticate')
        <li @if($selectedmenuitem_v == "Team") class="active" @endif role="presentation"><a href="/backend/users">Benutzerverwaltung</a></li>
        @endcan
        @can('view-logs')
        <li @if($selectedmenuitem_v == "Logs") class="active" @endif role="presentation"><a href="/backend/logs">Logübersicht</a></li>
        @endcan
    </ul>
@stop
@section('rightcol_content')
    @section('rightcol_content_lvl2')
        This is the right column of the contentarea. (backend)(lvl2)
    @show
@stop
