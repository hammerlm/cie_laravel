<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Gameday;

class InfoFrontendViewController extends Controller
{
    public function index() {
        return view('templateslvlone.infofe')->with([
            'user' => Auth::user(),
            'path'=>array("Info"),
            'pagetitle' => "Info",
            'selectedmenuitem_h' => 'Info',
            'paththumbnails'=>array("info-sign"),
            'nextgd' => \App\HelperClassCustom::getnextgameday(),
            'timedifftonextgd' => \App\HelperClassCustom::gettimedifferencecomparedtonow(\App\HelperClassCustom::getnextgameday())
        ]);
    }
}