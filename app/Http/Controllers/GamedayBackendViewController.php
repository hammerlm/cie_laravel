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
            $gamedaylist = Gameday::with('location', 'users')->orderBy('time', 'desc')->paginate(15);
            return view('templateslvlone.showgamedaylistbe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Spieltageübersicht"),
                'pagetitle' => "Spieltageübersicht",
                'gamedaylist' => $gamedaylist
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um die Spieltageübersicht im Verwaltungsbereich sehen zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
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
                'locationlist' => Location::lists('name', 'id')
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
            return view('templateslvlone.editgamedaysinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Spieltage","Spieltag bearbeiten"),
                'pagetitle' => "Spieltagsbearbeitung",
                'locationlist' => Location::lists('name', 'id'),
                'allusers' => User::all(),
                'gameday' => Gameday::find($id)
            ]);
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
            try {
                DB::beginTransaction();
                $gamedayentry = new Gameday();
                $gamedayentry->location_id = $request->location;
                $gamedayentry->time = $request->input('date') . ' ' . $request->input('time') . ':00';
                $gamedayentry->notes = $request->input('notes');
                $gamedayentry->save();
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Spieltagdatensatz wurde erfolgreich erstellt",
                    'infolvl' => "success",
                    'nexturl' => "/gamedays/" . $gamedayentry->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Sorry, es ist ein Fehler aufgetreten: " . $e->getMessage(),
                    'infolvl' => "danger",
                    'nexturl' => "/home",
                    'nexturldescription' => "Weiter"
                ]);
            }
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
                DB::beginTransaction();
                $gamedayentry = Gameday::find($id);
                $gamedayentry->location_id = $request->location;
                $gamedayentry->time = $request->input('date') . ' ' . $request->input('time') . ':00';
                $gamedayentry->notes = $request->input('notes');
                $gamedayentry->save();
                $userlist = $request->input('participantlist');
                DB::table('gameday_user')->where('gameday_id', '=', $gamedayentry->id)->delete();
                for($i = 0; $i < count($userlist); $i++) {
                    $user = User::find($userlist[$i]);
                    $gamedayentry->users()->attach($user);
                }
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Spieltagdatensatz wurde erfolgreich bearbeitet.",
                    'infolvl' => "success",
                    'nexturl' => "/gamedays/" . $gamedayentry->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Sorry, es ist ein Fehler aufgetreten: " . $e->getMessage(),
                    'infolvl' => "danger",
                    'nexturl' => "/home",
                    'nexturldescription' => "Weiter"
                ]);
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
            try {
                DB::beginTransaction();
                Gameday::destroy($id);
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Spieltagdatensatz wurde erfolgreich gelöscht",
                    'infolvl' => "success",
                    'nexturl' => "/gamedays",
                    'nexturldescription' => "Weiter"
                ]);
            } catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Sorry, es ist ein Fehler aufgetreten: " . $e->getMessage(),
                    'infolvl' => "danger",
                    'nexturl' => "/home",
                    'nexturldescription' => "Weiter"
                ]);
            }
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