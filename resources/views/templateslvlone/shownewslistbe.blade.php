@extends('templateslvlone.templateslvltwo.backendmaster')
@section('rightcol_content_lvl2')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Titel</th>
                <th>Zeitstempel</th>
                <th>Aktion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($newslist as $newsentry)
                <tr>
                    <td>{{$newsentry->id}}</td>
                    <td>{{$newsentry->title}}</td>
                    <td>{{$newsentry->created_at}}</td>
                    <td>
                        <a style="color:orangered" href="/backend/news/{{$newsentry->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a href="/news/{{$newsentry->id}}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                    </td>
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
    {!! Form::submit('Neuen Newsbeitrag erstellen', ["class" => "btn btn-default"]) !!}
    {!! Form::close() !!}
    @endcan
@stop
@stop