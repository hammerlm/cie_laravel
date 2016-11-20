@extends('templateslvlone.templateslvltwo.templateslvlthree.master')
@section('leftcol_content')

        <div align="center" class="panel panel-info">
            <div class="panel-heading">
                <h4>Nächster Eistermin</h4>
            </div>
            <div class="panel-body">
                @if($timedifftonextgd != false)
                <a href="/gamedays/{{$nextgd->id}}"><h4 align="center">{{$nextgd->location->name}} - {{ date('d.m.Y H:i', strtotime($nextgd->time)) }}</h4></a>
                <hr/>
                <!-- The following section contains all the code to make the countdownfunction work -->
                <!-- This code is derived from: https://www.sitepoint.com/build-javascript-countdown-timer-no-dependencies/ (SAT-Jul-30-2016) -->
                <div id="clockdiv_cd">
                    <div>
                        <span class="days_cd"></span>
                        <div class="smalltext_cd">Tage</div>
                    </div>
                    <div>
                        <span class="hours_cd"></span>
                        <div class="smalltext_cd">Stunden</div>
                    </div>
                    <div>
                        <span class="minutes_cd"></span>
                        <div class="smalltext_cd">Minuten</div>
                    </div>
                    <div>
                        <span class="seconds_cd"></span>
                        <div class="smalltext_cd">Sekunden</div>
                    </div>
                </div>
                <hr/>
                <h5>Momentan angemeldete Spieler: {{$nextgd->playercount_redundant}}</h5>
                <!-- Custom styles for this countdownfeature -->
                <link href="{{ asset('bootstrap-3.3.6-dist/css/plugins/custom_cd.css')}}" rel="stylesheet">
                <script type="text/javascript">
                    // This variable contains the deadlinedatetime
                    var deadline_cd = 'November 17 2016 15:00:00 GMT+0200';
                    var timedifftong = {{ $timedifftonextgd }} * 1000;
                    // This functions subtracts the datetime now from the enddatetime and returns the timedifference
                    function getTimeRemaining_cd(){
                        timedifftong = timedifftong - 1000;
                        if(timedifftong < 0) {
                            timedifftong = 0;
                        }
                        var t_cd = timedifftong;
                        var seconds_cd = Math.floor( (t_cd/1000) % 60 );
                        var minutes_cd = Math.floor( (t_cd/1000/60) % 60 );
                        var hours_cd = Math.floor( (t_cd/(1000*60*60)) % 24 );
                        var days_cd = Math.floor( t_cd/(1000*60*60*24) );
                        return {
                            'total_cd': t_cd,
                            'days_cd': days_cd,
                            'hours_cd': hours_cd,
                            'minutes_cd': minutes_cd,
                            'seconds_cd': seconds_cd
                        };
                    }
                    // This function outputs the clock data inside the div with id="clockdiv_cd"
                    function updateClock_cd(){
                        var clock_cd = document.getElementById('clockdiv_cd');
                        var daysSpan_cd = clock_cd.querySelector('.days_cd');
                        var hoursSpan_cd = clock_cd.querySelector('.hours_cd');
                        var minutesSpan_cd = clock_cd.querySelector('.minutes_cd');
                        var secondsSpan_cd = clock_cd.querySelector('.seconds_cd');
                        var t_cd = getTimeRemaining_cd();
                        //alert(t_cd.days_cd + ' - ' + t_cd.hours_cd + ' - ' + t_cd.minutes_cd + ' - ' + t_cd.seconds_cd);
                        daysSpan_cd.innerHTML = t_cd.days_cd;
                        hoursSpan_cd.innerHTML = ('0' + t_cd.hours_cd).slice(-2);
                        minutesSpan_cd.innerHTML = ('0' + t_cd.minutes_cd).slice(-2);
                        secondsSpan_cd.innerHTML = ('0' + t_cd.seconds_cd).slice(-2);
                    }
                    // This function executes the updateClock_cd-function periodically
                    function initializeClock_cd(){
                        var t_cd = getTimeRemaining_cd();
                        var timeinterval_cd = setInterval(updateClock_cd,1000);
                        if (t_cd.total <= 0) {
                            clearInterval(timeinterval_cd);
                        }
                    }
                    window.onload = function() {
                        updateClock_cd();
                        initializeClock_cd();
                    }
                </script>
                <!-- This is the end of the countdown-code -->
                @else
                    <div class="alert alert-danger" role="alert">Momentan stehen leider keine weiteren Eistermine fest!</div>
                @endif
            </div>
        </div>
    <!-- This is the beginning of the zabuto-calendar-code -->
    <!-- include the calendar js and css files -->
    <script src="{{ asset('bootstrap-3.3.6-dist/js/plugins/zabuto_calendar.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-3.3.6-dist/css/plugins/zabuto_calendar.min.css')}}">

    <!-- define the calendar element -->
    <div id="my-calendar"></div>
    <!-- initialize the calendar on ready -->
    <script type="application/javascript">
        $(document).ready(function () {
            $("#my-calendar").zabuto_calendar({today: true});
        });
    </script>
    <!-- This is the end of the zabuto-calendar-code -->
@stop
@section('rightcol_content')
    @section('rightcol_content_lvl2')
        This is the right column of the contentarea. (lvl2)
    @show
@stop