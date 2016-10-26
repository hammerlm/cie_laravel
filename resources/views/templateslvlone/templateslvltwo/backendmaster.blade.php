@extends('templateslvlone.templateslvltwo.templateslvlthree.master')
@section('leftcol_content')
    <ul class="nav nav-pills nav-stacked">
        @can('manage-news')
            <li role="presentation"><a href="/backend/news">News</a></li>
        @endcan
        @can('manage-gamedays')
        <li role="presentation"><a href="/backend/gamedays">Spieltageverwaltung</a></li>
        @endcan
        @can('manage-gamedays')
        <li role="presentation"><a href="/backend/users">Benutzerverwaltung</a></li>
        @endcan
        @can('manage-playercards')
        <li role="presentation"><a href="/backend/playercards">Playercardsverwaltung</a></li>
        @endcan
    </ul>
@stop
@section('rightcol_content')
    @section('rightcol_content_lvl2')
        This is the right column of the contentarea. (backend)(lvl2)
    @show
@stop
