@extends('templateslvlone.templateslvltwo.backendmaster')

@section('rightcol_content_lvl2')
    <h3>{{$userentry->name}}</h3>
    <div class="panel with-nav-tabs panel-default">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1default" data-toggle="tab">AAA-Bearbeitung</a></li>
                <li><a href="#tab2default" data-toggle="tab">Playercard-Bearbeitung</a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
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

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-user"></i> Speichern
                                        </button>
                                    </div>
                                </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2default">
                    <div class="row">
                        <div class="col-lg-12">
                            {{Form::open(['url' => '/backend/playercards/' . $userentry->id, 'method' => 'PUT'])}}
                                <div class="form-group">
                                    <label for="ca1" class="col-md-4 control-label">Alkoholkonsum</label>
                                    <input id="ca1" type="number" class="form-control" name="ca1" value="{{$userentry->customattribute1}}" />
                                </div>

                                <div class="form-group">
                                    <label for="ca2" class="col-md-4 control-label">Hockeyskills</label>
                                    <input id="ca2" type="number" class="form-control" name="ca2" value="{{$userentry->customattribute2}}" />
                                </div>

                                <div class="form-group">
                                    <label for="ca3" class="col-md-4 control-label">Forecheck</label>
                                    <input id="ca3" type="number" class="form-control" name="ca3"value="{{$userentry->customattribute3}}" />
                                </div>

                                <div class="form-group">
                                    <label for="ca4" class="col-md-4 control-label">Backcheck</label>
                                    <input id="ca4" type="number" class="form-control" name="ca4"value="{{$userentry->customattribute4}}" />
                                </div><hr/>

                                <div class="form-group">
                                    <label for="show_pc" class="col-md-4 control-label">Playercard anzeigen</label>
                                    <input id="show_pc" type="checkbox" class="form-control" name="show_pc"
                                    @if($userentry->show_playercard)
                                    checked
                                    @endif
                                    />
                                </div><hr/>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-user"></i> Speichern
                                        </button>
                                    </div>
                                </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
