@extends('templateslvlone.templateslvltwo.backendmaster')
@section('rightcol_content_lvl2')
    @if(count($gamedaylist) > 0)
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Ort</th>
                <th>Zeitstempel</th>
                <th>Aktion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($gamedaylist as $gameday)
                <tr>
                    <td>{{$gameday->id}}</td>
                    <td>{{$gameday->location->name}}</td>
                    <td>{{$gameday->time}}</td>
                    <td>
                        <a href="/gamedays/{{$gameday->id}}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                        @can('manage-gamedays')
                        <a href="/backend/gamedays/{{$gameday->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <hr/>
    {!! $gamedaylist->render() !!}
    @else
        <div class="alert alert-info" role="alert">Derzeit sind leider noch keine Spieltageinträge vorhanden!</div>
    @endif
    @can('manage-gamedays')
    {!! Form::open(['url' => url('/backend/gamedays/create'), 'method' => 'GET']) !!}
    {!! Form::submit('Neuen Spieltageintrag erstellen', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
@stop