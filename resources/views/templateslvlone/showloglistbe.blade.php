@extends('templateslvlone.templateslvltwo.backendmaster')
@section('rightcol_content_lvl2')
    @if(count($loglist) > 0)
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Beschreibung</th>
                <th>Zeitstempel</th>
            </tr>
            </thead>
            <tbody>
            @foreach($loglist as $logentry)
                <tr>
                    <td>{{$logentry->id}}</td>
                    <td>{{$logentry->description}}</td>
                    <td>{{ date('d.m.Y H:i', strtotime($logentry->created_at)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <hr/>
    {!! $loglist->render() !!}
    @else
        <div class="alert alert-info" role="alert">Derzeit sind leider noch keine Logeinträge vorhanden!</div>
    @endif
@stop