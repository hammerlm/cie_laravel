@extends('templateslvlone.templateslvltwo.backendmaster')

@section('rightcol_content_lvl2')
    <h3>{{$userentry->name}}</h3>
    <div class="panel with-nav-tabs panel-info">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                @php($active_passed = false)
                @if(Gate::allows('manage-users') || $user->id == $userentry->id)
                <li class="active"><a href="#tab1default" data-toggle="tab">Allgemein</a></li>
                @php($active_passed = true)
                @endif
                @can('manage-playercards')
                <li
                    @if(!$active_passed)
                    class="active"
                    @endif
                ><a href="#tab2default" data-toggle="tab">Playercardeinstellungen</a></li>
                @php($active_passed = true)
                @endcan
                @can('manage-permissions')
                <li
                        @if(!$active_passed)
                        class="active"
                        @endif
                        ><a href="#tab3default" data-toggle="tab">Autorisierung</a></li>
                @php($active_passed = true)
                @endcan
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                @php($active_passed2 = false)
                @if(Gate::allows('manage-users') || $user->id == $userentry->id)
                <div class="tab-pane fade in active" id="tab1default">
                    <div class="row">
                        <div class="col-lg-12">
                            {{Form::open(['url' => '/backend/users/' . $userentry->id, 'method' => 'PUT'])}}

                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">Vor- und Nachname</label>
                                    <input id="name" type="name" class="form-control" name="name" value="{{ $userentry->name }}"/>
                                </div><hr/>

                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">E-Mail Adresse</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $userentry->email }}"/>
                                </div><hr/>

                                <div class="form-group">
                                    <label for="change_pw" class="col-md-4 control-label">Passwort ändern</label>
                                    <input id="change_pw" type="checkbox" class="form-control" name="change_pw"/>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Passwort</label>
                                    <input id="password" type="password" class="form-control" name="password"/>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Passwort bestätigen</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password-confirm"/>
                                </div><hr/>

                                <div class="form-group">
                                    <label for="disable_account" class="col-md-4 control-label">Account deaktivieren</label>
                                    <input id="disable_account" type="checkbox" class="form-control" name="disable_account"
                                           @if($userentry->is_disabled)
                                           checked
                                           @endif
                                            />
                                </div><hr/>

                            {{Form::submit('Speichern',array('class' => 'btn btn-primary btn-sm'))}}
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
                @php($active_passed2 = true)
                @endif
                @can('manage-playercards')
                <div class="tab-pane fade
                @if(!$active_passed2)
                        in active
                @endif
                " id="tab2default">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Attributeinstellungen</h3>
                            {{Form::open(['url' => '/backend/playercards/' . $userentry->id, 'method' => 'PUT'])}}
                                <div class="form-group">
                                    <label for="ca6" class="col-md-4 control-label">Bevorzugte Position</label>
                                    <input id="ca6" type="text" class="form-control" name="ca6" value="{{$userentry->customattribute6}}" />
                                </div>

                                <div class="form-group">
                                    <label for="ca2" class="col-md-4 control-label">Bevorzugte Trikotnummer</label>
                                    <input id="ca2" type="number" class="form-control" name="ca2" value="{{$userentry->customattribute2}}" />
                                </div>

                                <div class="form-group">
                                    <label for="ca3" class="col-md-4 control-label">Alkoholkonsum</label>
                                    <input id="ca3" type="number" class="form-control" name="ca3"value="{{$userentry->customattribute3}}" />
                                </div>

                                <div class="form-group">
                                    <label for="ca4" class="col-md-4 control-label">Hockeysklills</label>
                                    <input id="ca4" type="number" class="form-control" name="ca4"value="{{$userentry->customattribute4}}" />
                                </div><hr/>

                                <div class="form-group">
                                    <label for="ca5" class="col-md-4 control-label">Priorität</label>
                                    <input id="ca5" type="number" class="form-control" name="ca5"value="{{$userentry->customattribute5}}" />
                                </div><hr/>

                                <div class="form-group">
                                    <label for="show_pc" class="col-md-4 control-label">Playercard anzeigen</label>
                                    <input id="show_pc" type="checkbox" class="form-control" name="show_pc"
                                    @if($userentry->show_playercard)
                                    checked
                                    @endif
                                    />
                                </div><hr/>

                                {!! Form::submit('Speichern', array('class'=>'btn btn-primary btn-sm')) !!}
                            {{Form::close()}}
                            <hr/>
                            <h3>Bilderupload</h3>
                            <div class="about-section">
                                <div class="text-content">
                                    <div class="span7 offset1">
                                        @if(Session::has('success'))
                                            <div class="alert-box success">
                                                <h2>{!! Session::get('success') !!}</h2>
                                            </div>
                                        @endif
                                        {!! Form::open(array('url'=>'/backend/playercardpictureupload/' . $userentry->id,'method'=>'PUT', 'files'=>true)) !!}
                                        <div class="control-group">
                                            <div class="controls">
                                                {!! Form::file('image') !!}
                                                <p class="errors">{!!$errors->first('image')!!}</p>
                                                @if(Session::has('error'))
                                                    <p class="errors">{!! Session::get('error') !!}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div id="success"> </div>
                                        {!! Form::submit('Hochladen', array('class'=>'btn btn-primary btn-sm')) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php($active_passed2 = true)
                @endcan
                @can('manage-permissions')
                <div class="tab-pane fade
                @if(!$active_passed2)
                        in active
                @endif
                " id="tab3default">
                    {{Form::open(['url' => '/backend/permissions/' . $userentry->id, 'method' => 'PUT'])}}
                    <div class="box-body">
                        <div class="form-group">
                            {{Form::label('rolegroups', 'Zugeteilte Rollengruppen')}}
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>Name</th>
                                    <th>Auswahl</th>
                                </tr>
                                @foreach ($rolegrouplist as $rolegroupentry)
                                    <tr>
                                        <td>{{ $rolegroupentry->name }}</td>
                                        <td align="center">{!! Form::checkbox("rolegrouplist[]", $rolegroupentry->id, $userentry->rolegroups->contains($rolegroupentry)) !!}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="form-group">
                            {{Form::submit('Speichern',array('class' => 'btn btn-primary btn-sm'))}}
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
                @php($active_passed2 = true)
                @endcan
            </div>
        </div>
    </div>
@endsection
