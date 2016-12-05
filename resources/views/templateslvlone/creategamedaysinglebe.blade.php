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
    {{Form::open(['url' => '/backend/gamedays/', 'method' => 'POST'])}}
    <div class="box-body">
        <div class="form-group">
            {{Form::label('locations', 'Spielort')}}
            {{Form::select('location', $locationlist)}}
        </div>
        <div class="form-group">
            {{Form::label('datetimeseason', 'Datum und Uhrzeit')}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="date">
                        <div class="input-group input-append date" id="datePicker">
                            <input type="text" class="form-control" name="date" value="{{(new DateTime())->format('Y-m-d')}}"/>
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
                                defaultTime: '15:00',
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
            {{Form::textarea('notes',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'msgbody'))}}
        </div>
        <div class="form-group">
            {{Form::submit('Eistermin hinzufügen',array('class' => 'btn btn-primary btn-sm'))}}
        </div>
    </div>
    {{Form::close()}}
@stop