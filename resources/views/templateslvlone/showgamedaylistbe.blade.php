@extends('templateslvlone.templateslvltwo.backendmaster')
@section('rightcol_content_lvl2')
    @if(count($gamedaylist) > 0)
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Ort</th>
                <th>Zeitstempel</th>
                <th>S</th>
                <th>G</th>
                <th>T</th>
                <th>R</th>
                <th>Aktion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($gamedaylist as $gameday)
                <tr>
                    <td>{{$gameday->id}}</td>
                    <td>{{$gameday->location->name}}</td>
                    <td>{{ date('d.m.Y H:i', strtotime($gameday->time)) }}</td>
                    <td>{{$gameday->playercount_redundant}}</td>
                    <td>{{$gameday->goaliecount_redundant}}</td>
                    <td>{{$gameday->coachcount_redundant}}</td>
                    <td>{{$gameday->refcount_redundant}}</td>
                    <td>
                        <a href="/gamedays/{{$gameday->id}}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                        <a style="color:orangered" href="/backend/gamedays/{{$gameday->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <hr/>
    {!! $gamedaylist->render() !!}
    @else
        <div class="alert alert-info" role="alert">Derzeit sind leider noch keine Eistermineinträge vorhanden!</div>
    @endif
    @can('manage-gamedays')
    {!! Form::open(['url' => url('/backend/gamedays/create'), 'method' => 'GET']) !!}
    {!! Form::submit('Neuen Eistermineintrag erstellen', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
    <hr/>
    <h3>Info:</h3>
    <p>S -> Spieleranzahl</p>
    <p>G -> Goalieanzahl</p>
    <p>T -> Traineranzahl</p>
    <p>R -> Schirianzahl</p>

@stop