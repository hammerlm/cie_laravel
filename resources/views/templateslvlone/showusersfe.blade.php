@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    <div class="panel with-nav-tabs panel-default">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1default" data-toggle="tab">Playercardansicht</a></li>
                @can('authenticate')
                <li><a href="#tab2default" data-toggle="tab">Spielerliste</a></li>
                @endcan
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1default">
                    @if(count($playercardlist) > 0)
                        @for ($i = 0; $i < intval((count($playercardlist) / 3)) + 1; $i++)
                            <div class="row">
                                @for ($j = $i * 3; $j < (($i * 3) + 3); $j++)
                                    @if(isset($playercardlist[$j]))
                                        <div class="col-lg-4">
                                            <div class="thumbnail">
                                                <img src="{{$playercardlist[$j]->picture_path}}" alt="Chuck Norris">
                                                <h4 align="center">{{$playercardlist[$j]->name}}</h4>
                                                <div class="caption">
                                                    <!-- Table -->
                                                    <table class="table">
                                                        <tr>
                                                            <td>Position</td>
                                                            <td>{{$playercardlist[$j]->customattribute6}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trikotnummer</td>
                                                            <td>{{$playercardlist[$j]->customattribute2}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alkoholkonsum</td>
                                                            <td>{{$playercardlist[$j]->customattribute3}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hockeyskills</td>
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
                    @else
                        <div class="alert alert-info" role="alert">Derzeit sind leider noch keine Playercards vorhanden!</div>
                    @endif
                </div>
                @can('authenticate')
                <div class="tab-pane fade" id="tab2default">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userlist as $userentry)
                                <tr>
                                    <td>{{$userentry->id}}</td>
                                    <td><a href="/users/{{$userentry->id}}">{{$userentry->name}}</a>
                                        @if(Gate::allows('authenticate'))
                                            @if(Gate::allows('manage-users-anyway') || $user->id == $userentry->id)
                                                <a style="color:orangered" href="/backend/users/{{$userentry->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endcan
            </div>
        </div>
    </div>
@stop