@extends('templateslvlone.templateslvltwo.backendmaster')
@section('rightcol_content_lvl2')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>id</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Playercard aktiviert</th>
            </tr>
            </thead>
            <tbody>
            <?php $iterationcount = 0; ?>
            @foreach($userlist as $userentry)
                <?php $iterationcount++; ?>
            <tr @if($userentry->is_disabled) style="background-color:orange"@endif>
                <td>{{$iterationcount}}</td>
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
    <h3>Info:</h3>
    <p><span style="background-color:orange">orange</span> -> Benutzer deaktiviert</p>
    <p>transparent/weiß -> Benutzer aktiviert</p>
    @can('manage-users')
    <hr/>
    {!! Form::open(['url' => url('/backend/users/create'), 'method' => 'GET']) !!}
    {!! Form::submit('Neuen Benutzer erstellen', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
@stop