@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    <div class="panel with-nav-tabs panel-default">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1default" data-toggle="tab">Playercardansicht</a></li>
                <li><a href="#tab2default" data-toggle="tab">Spielerliste</a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1default">
                    @for ($i = 0; $i < (count($playercardlist) / 3); $i++)
                        <div class="row">
                            @for ($j = $i * 3; $j < $i + 3; $j++)
                                @if(isset($playercardlist[$j]))
                                    <div class="col-lg-4">
                                        <div class="thumbnail">
                                            <img src="pics/cnorris.jpeg" alt="Chuck Norris">
                                            <h3 align="center">{{$playercardlist[$j]->name}}</h3>
                                            <div class="caption">
                                                <!-- Table -->
                                                <table class="table">
                                                    <tr>
                                                        <th>Attribut</th>
                                                        <th>Wert</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Alkoholkonsum</td>
                                                        <td>{{$playercardlist[$j]->customattribute1}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hockeyskills</td>
                                                        <td>{{$playercardlist[$j]->customattribute2}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Forecheck</td>
                                                        <td>{{$playercardlist[$j]->customattribute3}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Backcheck</td>
                                                        <td>{{$playercardlist[$j]->customattribute4}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endfor
                </div>
                <div class="tab-pane fade" id="tab2default">
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
                                    <td><a href="/users/{{$userentry->id}}">{{$userentry->name}}</a>
                                        @if(Gate::allows('manage-users-anyway') || $user->id == $userentry->id)
                                            <a style="color:orangered" href="/backend/users/{{$userentry->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        @endif
                                    </td>
                                    <td>{{$userentry->email}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop