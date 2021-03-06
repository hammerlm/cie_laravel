@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    <div class="panel with-nav-tabs panel-info">
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
                        @for ($i = 0; $i < intval((count($playercardlist) / 2)) + 1; $i++)
                            <div class="row">
                                @for ($j = $i * 2; $j < (($i * 2) + 2); $j++)
                                    @if(isset($playercardlist[$j]))
                                        <div class="col-lg-6">
                                            <div class="thumbnail">
                                                <img style="max-width: 250px" src="{{$playercardlist[$j]->picture_path}}">
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
                                                        @can('authenticate')
                                                            <tr>
                                                                <td>Bierkonsum</td>
                                                                <td>{{$playercardlist[$j]->customattribute3}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Hockeyskills</td>
                                                                <td>{{$playercardlist[$j]->customattribute4}}</td>
                                                            </tr>
                                                        @endcan
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        @endfor
                        {{$playercardlist->render()}}
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
                            <?php $iterationcount = 0; ?>
                            @foreach($userlist as $userentry)
                                <?php $iterationcount++; ?>
                                <tr>
                                    <td>{{$iterationcount}}</td>
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