@extends('masterlayoutfiles.backendmaster')
@section('scriptrefs_optional')
    <script src="summernote_wyswyg-editor/summernote.css"></script>
    <link rel="stylesheet" type="text/css" href="summernote_wyswyg-editor/summernote.min.js">
@stop
@section('rightcol_content_lvl2')
    <div id="summernote"><p>Hello Summernote</p></div>
    <script>
        $(document).ready(function() {

        });
    </script>
@stop