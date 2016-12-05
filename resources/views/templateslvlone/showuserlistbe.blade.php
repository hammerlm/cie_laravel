@extends('templateslvlone.templateslvltwo.backendmaster')
@section('rightcol_content_lvl2')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Playercard aktiviert</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userlist as $userentry)
            <tr @if($userentry->is_disabled) style="background-color:orange"@endif>
                <td>{{$userentry->id}}</td>
                <td><a href="/users/{{$userentry->id}}">{{$userentry->name}}</a>
                    @if(Gate::allows('manage-users-anyway') || $user->id == $userentry->id)
                         <a style="color:orangered" href="/backend/users/{{$userentry->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    @endif
                </td>
                <td>{{$userentry->email}}</td>
                <td>
                    @if($userentry->show_playercard)
                        ja
                    @else
                        nein
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <h3>Information:</h3>
    <p>Wenn ein Tabelleneintrag <span style="background-color:orange">orange</span> hinterlegt ist, bedeutet das, dass der jeweilige Benutzer deaktiviert ist und sich somit nicht authentifizieren kann.</p>
    @can('manage-users')
    <hr/>
    {!! Form::open(['url' => url('/backend/users/create'), 'method' => 'GET']) !!}
    {!! Form::submit('Neuen Benutzer erstellen', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
@stop