@extends('masterlayoutfiles.master')
@section('leftcol_content')
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active"><a href="#">Home</a></li>
        <li role="presentation"><a href="#">Profile</a></li>
        <li role="presentation"><a href="#">Messages</a></li>
    </ul>
@stop
@section('rightcol_content')
<p>This is my body content. (right - from the backend-master-layout.blade.php - file)</p>
@stop
