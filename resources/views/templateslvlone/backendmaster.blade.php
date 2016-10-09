@extends('templateslvlone.templateslvltwo.master')
@section('leftcol_content')
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active"><a href="#">Home</a></li>
        <li role="presentation"><a href="#">Profile</a></li>
        <li role="presentation"><a href="#">Messages</a></li>
    </ul>
@stop
@section('rightcol_content')
    @section('rightcol_content_lvl2')
        This is the right column of the contentarea. (backend)(lvl2)
    @show
@stop
