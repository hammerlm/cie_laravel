@extends('templateslvlone.templateslvltwo.backendmaster')
@section('scriptrefs_optional')
    <!-- Include Bootstrap Datepicker -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

    <style type="text/css">
    /**
     * Override feedback icon position
     * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
     */
    #eventForm .form-control-feedback {
        top: 0;
        right: -15px;
    }
    </style>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@stop
@section('rightcol_content_lvl2')
    {{Form::open(['url' => '/backend/gamedays/' . $gameday->id, 'method' => 'PUT'])}}
    <div class="box-body">
        <div class="form-group">
            {{Form::label('locations', 'Spielort')}}
            {{Form::select('location', $locationlist, $gameday->location_id)}}
        </div>
        <div class="form-group">
            {{Form::label('datetimeseason', 'Datum und Uhrzeit')}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="date">
                        <div class="input-group input-append date" id="datePicker">
                            <input type="text" class="form-control" name="date" value="{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $gameday->time)->format('Y-m-d')}}"/>
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('#datePicker')
                                    .datepicker({
                                        format: 'yyyy-mm-dd'
                                    })
                                    .on('changeDate', function(e) {
                                        // Revalidate the date field
                                        $('#eventForm').formValidation('revalidateField', 'date');
                                    });
                        });
                    </script>
                </div>
                <div class="col-lg-4">
                    <input name="time" class="timepicker"/>

                    <script>
                        $(document).ready(function(){
                            $('.timepicker').timepicker({
                                timeFormat: 'HH:mm',
                                interval: 15,
                                minTime: '00:00',
                                maxTime: '23:59',
                                defaultTime: '{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $gameday->time)->format('H:i')}}',
                                startTime: '00:00',
                                dynamic: false,
                                dropdown: true,
                                scrollbar: true
                            });


                        });
                    </script>
                    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
                </div>
            </div>
        </div>
        <hr/>
        <div class="form-group">
            {{Form::label('notes', 'Anmerkungen')}}
            {{Form::textarea('notes',$gameday->notes,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'msgbody'))}}
        </div>
        <div class="form-group">
            {{Form::label('maxfplayersalert', 'Maximale Feldspieleranzahl erreicht?')}} <br/>
            @if($gameday->show_maxfplayersalert)
                {!! Form::checkbox("maxfplayersalert", $gameday->id,  true)!!}
            @else
                {!! Form::checkbox("maxfplayersalert", $gameday->id,  false)!!}
            @endif
        </div>
        <div class="form-group">
            {{Form::label('maxgoaliesalert', 'Maximale Tormannanzahl erreicht?')}} <br/>
            @if($gameday->show_maxgoaliesalert)
                {!! Form::checkbox("maxgoaliesalert", $gameday->id,  true)!!}
            @else
                {!! Form::checkbox("maxgoaliesalert", $gameday->id,  false)!!}
            @endif
        </div>
        <div class="form-group">
            {{Form::label('participants', 'Teilnehmer')}}
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th align="center">Teilnahme</th>
                        <th align="center">... als Tormann?</th>
                        <th align="center">... als Trainer</th>
                        <th align="center">... als Referee?</th>
                    </tr>
                    </thead>

                @foreach ($allusers as $participant)
                    <tr>
                        <td>{{ $participant->name }}</td>
                        <td align="center">{!! Form::checkbox("participantlist[]", $participant->id, $gameday->users->contains($participant)) !!}</td>
                        <td align="center">{!! Form::checkbox("goalielist[]", $participant->id, $goalies->contains($participant)) !!}</td>
                        <td align="center">{!! Form::checkbox("coachlist[]", $participant->id, $coaches->contains($participant)) !!}</td>
                        <td align="center">{!! Form::checkbox("reflist[]", $participant->id, $refs->contains($participant)) !!}</td>
                    </tr>
                @endforeach
            </table>
            </div>
        </div>
        <hr/>
        <div class="form-group">
            {{Form::submit('Speichern',array('class' => 'btn btn-primary btn-sm'))}}
        </div>
    </div>
    {{Form::close()}}
    <hr/>
    {!! Form::open(['url' => url('/backend/gamedays/' . $gameday->id), 'method' => 'DELETE']) !!}
    {!! Form::submit('Löschen', ["class" => "btn btn-danger btn-sm"]) !!}
    {!! Form::close() !!}
@stop