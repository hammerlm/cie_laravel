@extends('templateslvlone.templateslvltwo.backendmaster')
@section('rightcol_content_lvl2')
    {{Form::open(['url' => 'foo/bar'])}}
    <div class="box-body">
        <div class="form-group">
            {{Form::label('location', 'Spielort')}}
            {{Form::text('location',null,array('class' => 'form-control', 'placeholder'=>'Titel'))}}
        </div>
        <div class="form-group">
            {{Form::label('date', 'Datum')}}
            {{Form::textarea('date',null,array('class' => 'form-control', 'placeholder'=>'Betreff', 'id' => 'msgsubject'))}}
        </div>
        <div class="form-group">
            {{Form::label('Uhrzeit', 'time')}}
            {{Form::textarea('body',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'msgbody'))}}
        </div>
        <div class="form-group">
            {{Form::submit('Spieltermin hinzufügen',array('class' => 'btn btn-primary btn-sm'))}}
        </div>
    </div>
    {{Form::close()}}
@stop