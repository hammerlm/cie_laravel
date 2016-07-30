@extends('masterlayoutfiles.master')
@section('leftcol_content')
    <!-- The following section contains all the code to make the countdownfunction work -->
    <!-- This code is derived from: https://www.sitepoint.com/build-javascript-countdown-timer-no-dependencies/ (SAT-Jul-30-2016) -->
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
        function initializeClock(id_cd, endtime_cd){
            var clock_cd = document.getElementById(id_cd);
            var timeinterval_cd = setInterval(function(){
                var t_cd = getTimeRemaining_cd(endtime_cd);
                clock_cd.innerHTML = 'days: ' + t_cd.days_cd + '<br>' +
                        'hours: '+ t_cd.hours_cd + '<br>' +
                        'minutes: ' + t_cd.minutes_cd + '<br>' +
                        'seconds: ' + t_cd.seconds_cd;
                if(t_cd.total<=0){
                    clearInterval(timeinterval_cd);
                }
            },1000);
        }
        // initializeClock('clockdiv_cd', deadline_cd);

    </script>

    <div id="clockdiv_cd">

    </div>
    <!-- This is the end of the countdown-code -->
@stop
@section('rightcol_content')
    @section('rightcol_content_lvl2')
        This is the right column of the contentarea. (lvl2)
    @show
@stop