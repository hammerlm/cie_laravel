@extends('templateslvlone.templateslvltwo.backendmaster')
@section('rightcol_content_lvl2')
    <div class="alert alert-{{$infolvl}}" role="alert">{{$infomsg}}</div>
    {!! Form::open(['url' => url($nexturl), 'method' => 'GET']) !!}
    {!! Form::submit($nexturldescription, ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
@stop