@extends('templateslvlone.templateslvltwo.backendmaster')
@section('rightcol_content_lvl2')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Titel</th>
                <th>Zeitstempel</th>
            </tr>
            </thead>
            <tbody>
            @foreach($newslist as $newsentry)
                <tr>
                    <td>{{$newsentry->id}}</td>
                    <td>
                        <a href="/news/{{$newsentry->id}}">{{$newsentry->title}}</a> <a style="color:orangered" href="/backend/news/{{$newsentry->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    </td>
                    <td>{{ date('d.m.Y H:i', strtotime($newsentry->created_at)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <hr/>
    {!! $newslist->render() !!}
    @can('manage-news')
    <hr/>
    {!! Form::open(['url' => url('/backend/news/create'), 'method' => 'GET']) !!}
    {!! Form::submit('Neuen Newsbeitrag erstellen', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
@stop