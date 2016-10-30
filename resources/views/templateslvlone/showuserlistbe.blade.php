@extends('templateslvlone.templateslvltwo.backendmaster')
@section('rightcol_content_lvl2')
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
            @foreach($userlist as $userentry)
            <tr>
                <td>{{$userentry->id}}</td>
                <td><a href="/users/{{$userentry->id}}">{{$userentry->name}}</a> <a href="/backend/users/{{$userentry->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                <td>{{$userentry->email}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @can('manage-users')
    <hr/>
    {!! Form::open(['url' => url('/backend/users/create'), 'method' => 'GET']) !!}
    {!! Form::submit('Neuen Benutzer erstellen', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
@stop