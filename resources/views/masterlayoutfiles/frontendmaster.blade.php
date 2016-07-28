@extends('masterlayoutfiles.master')
@section('leftcol_content')
<p>This is my body content. (left - from the frontend-master-layout.blade.php - file)</p>
@stop
@section('rightcol_content')
    @section('rightcol_content_lvl2')
        This is the right column of the contentarea. (lvl2)
    @show
@stop