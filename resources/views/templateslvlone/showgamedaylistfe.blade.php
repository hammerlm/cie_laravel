@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    @if(count($gamedaylist) > 0)
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Ort</th>
                <th>Zeitstempel</th>
                <th>Spieleranzahl</th>
                <th>Goalieanzahl</th>
                <th>Aktion</th>
            </tr>
            </thead>
            <tbody>
            @foreach($gamedaylist as $gameday)
                <tr>
                    <td>{{$gameday->location->name}}</td>
                    <td>{{ date('d.m.Y H:i', strtotime($gameday->time)) }}</td>
                    <td>{{$gameday->playercount_redundant}}</td>
                    <td>{{$gameday->goaliecount_redundant}}</td>
                    <td>
                        <a href="/gamedays/{{$gameday->id}}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                        @can('manage-gamedays')
                        <a style="color:orangered" href="/backend/gamedays/{{$gameday->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <hr/>
    {!! $gamedaylist->render() !!}
    <hr/>
    <!-- Linechart -->




    <!-- End Linechart -->
    @else
        <div class="alert alert-info" role="alert">Derzeit sind leider noch keine Eistermineinträge vorhanden!</div>
    @endif
    @can('manage-gamedays')
    {!! Form::open(['url' => url('/backend/gamedays/create'), 'method' => 'GET']) !!}
    {!! Form::submit('Neuen Eistermineintrag erstellen', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
@stop