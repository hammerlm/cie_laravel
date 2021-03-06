@extends('dummycontentviews.masterlayoutfiles.master')
@section('leftcol_content')
    <div align="center" class="panel panel-info">
        <div class="panel-heading">
            <h4>Nächster Eistermin</h4>
        </div>
        <div class="panel-body">
            <h4 align="center">Radenthein - 17.09.2016 - 15:00</h4>
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
            <h5>Momentan angemeldete Speler: 7</h5>
            <!-- Custom styles for this countdownfeature -->
            <link href="bootstrap-3.3.6-dist/css/plugins/custom_cd.css" rel="stylesheet">
            <script type="text/javascript">
                // This variable contains the deadlinedatetime
                var deadline_cd = 'September 17 2016 15:00:00 GMT+0200';
                // This functions subtracts the datetime now from the enddatetime and returns the timedifference
                function getTimeRemaining_cd(endtime_cd){
                    var t_cd = Date.parse(endtime_cd) - Date.parse(new Date());
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
                    var t_cd = getTimeRemaining_cd(deadline_cd);
                    //alert(t_cd.days_cd + ' - ' + t_cd.hours_cd + ' - ' + t_cd.minutes_cd + ' - ' + t_cd.seconds_cd);
                    daysSpan_cd.innerHTML = t_cd.days_cd;
                    hoursSpan_cd.innerHTML = ('0' + t_cd.hours_cd).slice(-2);
                    minutesSpan_cd.innerHTML = ('0' + t_cd.minutes_cd).slice(-2);
                    secondsSpan_cd.innerHTML = ('0' + t_cd.seconds_cd).slice(-2);
                }
                // This function executes the updateClock_cd-function periodically
                function initializeClock_cd(){
                    var t_cd = getTimeRemaining_cd(deadline_cd);
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
        </div>
    </div>
    <!-- This is the beginning of the zabuto-calendar-code -->
    <!-- include the calendar js and css files -->
    <script src="bootstrap-3.3.6-dist/js/plugins/zabuto_calendar.min.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.6-dist/css/plugins/zabuto_calendar.min.css">

    <!-- define the calendar element -->
    <div id="my-calendar"></div>
    <!-- initialize the calendar on ready -->
    <script type="application/javascript">
        $(document).ready(function () {
            $("#my-calendar").zabuto_calendar();
        });
    </script>
    <!-- This is the end of the zabuto-calendar-code -->
@stop
@section('rightcol_content')
    @section('rightcol_content_lvl2')
        This is the right column of the contentarea. (lvl2)
    @show
@stop