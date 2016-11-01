<?php

namespace App;



class HelperClassCustom
{
    public static function getnextgameday() {
        return Gameday::where('time', '>', \Carbon\Carbon::now())->orderBy('time')->get()->first();
    }

    public static function gettimedifferencecomparedtonow($gd) {
        if(isset($gd)){
            return HelperClassCustom::stime_difference($gd->time, \Carbon\Carbon::now());
        }
        return false;
    }

    public static function stime_difference($t1, $t2) {
        $date1Timestamp = strtotime($t1);
        $date2Timestamp = strtotime($t2);

        $difference = $date1Timestamp - $date2Timestamp;

        return $difference;
    }

}
