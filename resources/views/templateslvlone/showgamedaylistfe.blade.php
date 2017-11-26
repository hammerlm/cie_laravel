@extends('templateslvlone.templateslvltwo.frontendmaster')
@section('rightcol_content_lvl2')
    @if(count($gamedaylist) > 0)
    <div class="panel with-nav-tabs panel-info">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1default" data-toggle="tab">Übersicht</a></li>
                <li><a href="#tab2default" data-toggle="tab">Trend</a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1default">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Ort</th>
                                    <th>Zeitstempel</th>
                                    <th>Spieleranzahl</th>
                                    <th>Goalieanzahl</th>
                                    <th>Aktion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($gamedaylist as $gameday)
                                    <tr>
                                        <td>{{$gameday->location->name}}</td>
                                        <td>{{ date('d.m.Y H:i', strtotime($gameday->time)) }}</td>
                                        <td>{{$gameday->playercount_redundant}}</td>
                                        <td>{{$gameday->goaliecount_redundant}}</td>
                                        <td>
                                            <a href="/gamedays/{{$gameday->id}}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                            @can('manage-gamedays')
                                            <a style="color:orangered" href="/backend/gamedays/{{$gameday->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr/>
                        {!! $gamedaylist->render() !!}
                </div>
                <div class="tab-pane fade" id="tab2default">
                    <!-- Linechart -->
                    <script async="" src="{{ asset('scripting/js/plugins/analytics.js')}}"></script>
                    <script src="{{ asset('scripting/js/plugins/Chart.js')}}"></script>
                    <style type="text/css">/* Chart.js */
                        @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
                    </style>
                    <script src="{{ asset('scripting/js/plugins/utils.js')}}"></script>
                    <style>
                        canvas{
                            -moz-user-select: none;
                            -webkit-user-select: none;
                            -ms-user-select: none;
                        }
                    </style>

                    <div style="width:75%;"><div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="canvas" style="display: block; width: 1338px; height: 669px;" width="1338" height="669" class="chartjs-render-monitor"></canvas>
                    </div>
                    <script>
                        var config = {
                            type: 'line',
                            data: {
                                labels: [
                                    @foreach($chartdata as $datarow)
                                                "{{date('d.m.Y', strtotime($datarow->time))}}",
                                    @endforeach
                                    "Prognose"
                        ],
                                datasets: [{
                                    label: "Spieleranzahl",
                                    backgroundColor: window.chartColors.red,
                                    borderColor: window.chartColors.red,
                                    data: [
                                            @foreach($chartdata as $datarow)
                                                {{$datarow->playercount_redundant}},
                                            @endforeach
                                            {{$chartdata->avg('playercount_redundant')}}
                                    ],
                                    fill: false,
                                }, {
                                    label: "Goalieanzahl",
                                    fill: false,
                                    backgroundColor: window.chartColors.green,
                                    borderColor: window.chartColors.green,
                                    data: [
                                        @foreach($chartdata as $datarow)
                                                {{$datarow->goaliecount_redundant}},
                                        @endforeach
                                        {{$chartdata->avg('goaliecount_redundant')}}
                                ],
                                }, {
                                    label: "Schirianzahl",
                                    fill: false,
                                    backgroundColor: window.chartColors.yellow,
                                    borderColor: window.chartColors.yellow,
                                    data: [
                                        @foreach($chartdata as $datarow)
                                                {{$datarow->refcount_redundant}},
                                        @endforeach
                                        {{$chartdata->avg('refcount_redundant')}}
                                ],
                                }, {
                                    label: "Traineranzahl",
                                    fill: false,
                                    backgroundColor: window.chartColors.blue,
                                    borderColor: window.chartColors.blue,
                                    data: [
                                        @foreach($chartdata as $datarow)
                                                {{$datarow->coachcount_redundant}},
                                        @endforeach
                                        {{$chartdata->avg('coachcount_redundant')}}
                                ],
                                }, {
                                    label: "Gesamt",
                                    fill: false,
                                    backgroundColor: window.chartColors.orange,
                                    borderColor: window.chartColors.orange,
                                    data: [
                                        @foreach($chartdata as $datarow)
                                                {{$datarow->goaliecount_redundant + $datarow->refcount_redundant + $datarow->playercount_redundant + $datarow->coachcount_redundant}},
                                        @endforeach
                                        {{$chartdata->avg('goaliecount_redundant') + $chartdata->avg('refcount_redundant') + $chartdata->avg('playercount_redundant') + $chartdata->avg('coachcount_redundant')}}
                                ],
                                }]
                            },
                            options: {
                                responsive: true,
                                title:{
                                    display:true,
                                    text:'Chart.js Line Chart'
                                },
                                tooltips: {
                                    mode: 'index',
                                    intersect: false,
                                },
                                hover: {
                                    mode: 'nearest',
                                    intersect: true
                                },
                                scales: {
                                    xAxes: [{
                                        display: true,
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Datum'
                                        }
                                    }],
                                    yAxes: [{
                                        display: true,
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Anzahl'
                                        }
                                    }]
                                }
                            }
                        };

                        window.onload = function() {
                            var ctx = document.getElementById("canvas").getContext("2d");
                            window.myLine = new Chart(ctx, config);
                        };

                        var colorNames = Object.keys(window.chartColors);
                    </script>
                    <!-- End Linechart -->
                    <hr/>
                    <p>
                        Dieses Diagramm stellt den Trend der letzten zehn Eistermine in einer Zusammensetzung aus fünf Graphen dar:
                        <ul>
                            <li style="color:red">Spieleranzahl</li>
                            <li style="color:green">Goalieanzahl</li>
                            <li style="color:black">Schirianzahl</li>
                            <li style="color:blue">Traineranzahl</li>
                            <li style="color:orange">Gesamt</li>
                        </ul>
                        Jedoch gibt es einen zusätzlichen Datensatz namens "Prognose". Dieser berechnet sich aus dem Durchschnitt der vorherigen zehn Datensätze, um eine Schätzgrundlage für den nächsten Eistermin zur Verfügung zu stellen.
                    Demnach sollten am nächsten Spieltag @if($timedifftonextgd != false)({{date('d.m.Y', strtotime($nextgd->time))}})@endif insgesamt
                    {{round($chartdata->avg('goaliecount_redundant') + $chartdata->avg('refcount_redundant') + $chartdata->avg('playercount_redundant') + $chartdata->avg('coachcount_redundant'))}} Personen teilnehmen.
                    </p>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-info" role="alert">Derzeit sind leider noch keine Eistermineinträge vorhanden!</div>
    @endif
    @can('manage-gamedays')
    {!! Form::open(['url' => url('/backend/gamedays/create'), 'method' => 'GET']) !!}
    {!! Form::submit('Neuen Eistermineintrag erstellen', ["class" => "btn btn-default btn-sm"]) !!}
    {!! Form::close() !!}
    @endcan
@stop