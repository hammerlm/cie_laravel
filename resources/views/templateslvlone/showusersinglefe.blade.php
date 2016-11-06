@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    <h3>{{$userentry->name}}</h3>
    @can('authenticate')
    <div class="form-group">
        {{Form::label('email', 'E-Mail')}} <br/>
        {{$userentry->email}}
    </div>
    @endcan
    <div class="form-group">
        {{Form::label('status', 'Accountstatus')}}<br/>
        @if($userentry->is_disabled)
        Account ist zur Zeit deaktiviert
        @else
        Account ist zur Zeit aktiviert
        @endif
    </div>
    @can('authenticate')
    <div class="form-group">
        {{Form::label('permissioninfo', 'Zugewiesene Rollengruppen')}}
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Beschreibung</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userentry->rolegroups as $rolegroupentry)
                    <tr>
                        <td>{{$rolegroupentry->id}}</td>
                        <td>{{$rolegroupentry->name}}</td>
                        <td>{{$rolegroupentry->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endcan
@stop