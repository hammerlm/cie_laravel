@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    <div align="center" class="panel panel-info">
        <div class="panel-heading">
            <h4>{{$gameday->location->name}} - {{$gameday->time}}</h4>
        </div>
        <div class="panel-body">
            <h3>Anmerkungen</h3>
            <p>
                {{$gameday->notes}}
            </p>
            <hr/>
            <h3>Teilnehmerliste ({{count($gameday->users)}})</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gameday->users as $participant)
                        <tr>
                            <td>{{$participant->id}}</td>
                            <td>{{$participant->name}}</td>
                            <td>{{$participant->email}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @can('manage-news')
    <hr/>
    {!! Form::open(['url' => url('/backend/gamedays/' . $gameday->id . '/edit'), 'method' => 'GET']) !!}
    {!! Form::submit('Diesen Spieltageintrag bearbeiten', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    <hr/>
    {!! Form::open(['url' => url('/backend/gamedays/' . $gameday->id), 'method' => 'DELETE']) !!}
    {!! Form::submit('Diesen Spieltageintrag löschen', ["class" => "btn btn-danger btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
@stop