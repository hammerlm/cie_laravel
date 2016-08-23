@extends('masterlayoutfiles.backendmaster')
@section('scriptrefs_optional')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
@stop
@section('rightcol_content_lvl2')
    {{Form::open(['url' => 'foo/bar'])}}
        <div class="box-body">
            <div class="form-group">
                {{Form::label('title', 'Titel')}}
                {{Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Titel'))}}
            </div>
            <div class="form-group">
                {{Form::label('subject', 'Betreff')}}
                {{Form::textarea('subject',null,array('class' => 'form-control', 'placeholder'=>'Betreff', 'id' => 'msgsubject'))}}
            </div>
            <div class="form-group">
                {{Form::label('body', 'Inhalt')}}
                {{Form::textarea('body',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'msgbody'))}}
            </div>
            <div class="form-group">
                {{Form::submit('Save Post',array('class' => 'btn btn-primary btn-sm'))}}
            </div>
        </div>
    {{Form::close()}}
    <script>
        $(document).ready(function() {
            $('#msgsubject').summernote({
                height:100,
            });
            $('#msgbody').summernote({
                height:250,
            });
        });
    </script>
@stop