@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    <div align="center" class="panel panel-info">
        <div class="panel-heading">
            <h4>{{$gameday->location->name}} - {{ date('d.m.Y H:i', strtotime($gameday->time)) }}</h4>
        </div>
        <div class="panel-body">
            <h3>Anmerkungen</h3>
            <p>
                {{$gameday->notes}}
            </p>
            <h3>Teilnehmeranzahl: {{$gameday->playercount_redundant}}</h3>
            <h4>Spieleranzahl: {{$gameday->playercount_redundant - $gameday->goaliecount_redundant}}</h4>
            <h4>Goalieanzahl: {{$gameday->goaliecount_redundant}}</h4>
            <p>Zuletzt aktualisiert: {{ date('d.m.Y H:i', strtotime($gameday->updated_at)) }}</p>
            @can('authenticate')
                <hr/>
                <h3>Teilnehmerliste</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gameday->users as $participant)
                            <tr @if($participant->pivot->is_goalie)
                                style="background-color:lawngreen"
                                @endif
                            >
                                <td>{{$participant->id}}</td>
                                <td>{{$participant->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <h3>Information:</h3>
                <p>Wenn ein Tabelleneintrag <span style="background-color:lawngreen">grün</span> hinterlegt ist, bedeutet das, dass der jeweilige Spieler ein Tormann ist.</p>
            @endcan
        </div>
    </div>
    @can('manage-gamedays')
    <hr/>
    {!! Form::open(['url' => url('/backend/gamedays/' . $gameday->id . '/edit'), 'method' => 'GET']) !!}
    {!! Form::submit('Diesen Eistermineintrag bearbeiten', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
@stop