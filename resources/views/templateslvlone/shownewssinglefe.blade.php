@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    <div class="row">
        <div class="col-lg-12">
            <h1>{{$newsentry->title}}</h1>
            <hr/>
            <h5>Erstellt am {{ date('d.m.Y H:i', strtotime($newsentry->created_at)) }}, von <a href="/users/{{$newsentry->creator->id}}">{{$newsentry->creator->name}}</a></h5>
            <h5>Zuletzt editiert am {{ date('d.m.Y H:i', strtotime($newsentry->updated_at)) }}, von <a href="/users/{{$newsentry->modifier->id}}">{{$newsentry->modifier->name}}</a></h5>
            <h5>Kategorien:
                @foreach($newsentry->categories as $category)
                    <span class="label label-default">{{$category->name}}</span>
                @endforeach
            </h5>
            <hr/>
            <p>
                {!! $newsentry->body !!}
            </p>
        </div>
    </div>
    @can('manage-news')
    <hr/>
    {!! Form::open(['url' => url('/backend/news/' . $newsentry->id . '/edit'), 'method' => 'GET']) !!}
    {!! Form::submit('Diesen Newsbeitrag bearbeiten', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    <hr/>
    {!! Form::open(['url' => url('/backend/news/' . $newsentry->id), 'method' => 'DELETE']) !!}
    {!! Form::submit('Diesen Newsbeitrag löschen', ["class" => "btn btn-danger btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
@stop