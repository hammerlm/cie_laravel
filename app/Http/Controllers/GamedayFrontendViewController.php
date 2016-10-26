<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Gameday;
use DB;

class GamedayFrontendViewController extends Controller
{
    public function index() {
        $gamedaylist = Gameday::with('location', 'users')->orderBy('time', 'desc')->paginate(15);
        return view('templateslvlone.showgamedaylistfe')->with([
            'user' => Auth::user(),
            'path'=>array("Frontend","Spieltageübersicht"),
            'pagetitle' => "Spieltageübersicht",
            'gamedaylist' => $gamedaylist
        ]);
    }

    public function show($id) {
        $gameday = Gameday::find($id);
        return view('templateslvlone.showgamedaysinglefe')->with([
            'user' => Auth::user(),
            'path'=>array("Frontend","Spieltage","News-Einzelansicht"),
            'pagetitle' => "Spieltagseinzelansicht",
            'gameday' => $gameday
        ]);
    }
}