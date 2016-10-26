<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Gameday;
use App\Location;
use DB;

class GamedayBackendViewController extends Controller
{
    public function index() {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            $gamedaylist = Gameday::with('locations', 'users')->orderBy('time', 'desc')->paginate(15);
            return view('templateslvlone.showgamedaylistfe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Home"),
                'pagetitle' => "Spieltageübersicht",
                'gamedaylist' => $gamedaylist
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um die Spieltagsübersicht im Verwaltungsbereich sehen zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function create()
    {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            return view('templateslvlone.creategamedaysinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Spieltage","Spieltag erstellen"),
                'pagetitle' => "Spieltagserstellung",
                'locationlist' => Location::all()
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Spieltagsdatensatz erstellen zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function edit($id)
    {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {

        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Spieltagsdatensatz bearbeiten zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {

        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Spieltagsdatensatz erstellen zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function update(Request $request, $id) {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            try {

            } catch ( Exception $e ){

            }
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Spieltagsdatensatz bearbeiten zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function destroy($id) {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {

        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Spieltagsdatensatz löschen zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }
}