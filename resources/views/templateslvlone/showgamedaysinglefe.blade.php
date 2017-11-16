@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    <div align="center" class="panel panel-default">
        <div class="panel-heading">
            <h4>{{$gameday->location->name}} - {{ date('d.m.Y H:i', strtotime($gameday->time)) }}</h4>
        </div>
        <div class="panel-body">
            <h3>Anmerkungen</h3>
            <hr/>
            <p>
                {{$gameday->notes}}
            </p>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Spieleranzahl</td>
                        <td>{{$gameday->playercount_redundant}}</td>
                    </tr>
                    <tr>
                        <td>Goalieanzahl</td>
                        <td>{{$gameday->goaliecount_redundant}}</td>
                    </tr>
                    <tr>
                        <td>Traineranzahl</td>
                        <td>{{$gameday->coachcount_redundant}}</td>
                    </tr>
                    <tr>
                        <td>Schirianzahl</td>
                        <td>{{$gameday->refcount_redundant}}</td>
                    </tr>
                    <tr>
                        <td>Zuletzt aktualisiert</td>
                        <td>{{ date('d.m.Y H:i', strtotime($gameday->updated_at)) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
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
                        <?php $iterationcount = 0; ?>
                        @foreach($gameday->users as $participant)
                            <?php $iterationcount++; ?>

                            <tr @if($participant->pivot->is_goalie)
                                style="background-color:lawngreen"
                                @elseif($participant->pivot->is_coach)
                                style="background-color:lightskyblue"
                                @elseif($participant->pivot->is_ref)
                                style="background-color:black;color:white"
                                @endif
                            >
                                <td>{{$iterationcount}}</td>
                                <td>{{$participant->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <h3>Info:</h3>
                <p><span style="background-color:lawngreen">grün</span> -> Tormann</p>
                <p><span style="background-color:lightskyblue">hellblau</span> -> (Spieler)trainer</p>
                <p><span style="background-color:black;color:white">schwarz</span> -> Schiri</p>
                <p>transparent/weiß -> Feldspieler</p>
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