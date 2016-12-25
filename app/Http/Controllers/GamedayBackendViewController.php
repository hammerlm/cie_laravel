<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Gameday;
use App\Location;
use App\Log;
use Illuminate\Support\Facades\DB;

class GamedayBackendViewController extends Controller
{
    //This function returns a list of all gamedays represented in the showgamedaylistbe-view
    public function index() {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            $gamedaylist = Gameday::with('location', 'users')->orderBy('time', 'desc')->paginate(15);
            return view('templateslvlone.showgamedaylistbe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Eistermine"),
                'pagetitle' => "Eisterminübersicht",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Gamedays',
                'paththumbnails'=>array("dashboard", "list-alt"),
                'gamedaylist' => $gamedaylist
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Gamedays',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um die Eisterminübersicht im Verwaltungsbereich sehen zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    //this function returns the creation-view for gamedays
    public function create()
    {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            return view('templateslvlone.creategamedaysinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Eistermine","Eistermin erstellen"),
                'pagetitle' => "Eisterminerstellung",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Gamedays',
                'paththumbnails'=>array("dashboard", "list-alt", "plus"),
                'locationlist' => Location::lists('name', 'id')
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Gamedays',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Eistermindatensatz erstellen zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    //this function returns the edit-view for gamedays
    public function edit($id)
    {
        $gd = Gameday::find($id);
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            return view('templateslvlone.editgamedaysinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Eistermine","Eistermin bearbeiten"),
                'pagetitle' => "Eisterminbearbeitung",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Gamedays',
                'paththumbnails'=>array("dashboard", "list-alt", "pencil"),
                'locationlist' => Location::lists('name', 'id'),
                'allusers' => User::all()->sortby('name'),
                'goalies' => $gd->users()->wherePivot('is_goalie', 1)->get(),
                'gameday' => $gd
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Gamedays',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Eistermindatensatz bearbeiten zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    //this function stores a gamedayentry into the db, based on the http-request
    public function store(Request $request)
    {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                $gamedayentry = new Gameday();
                $gamedayentry->location_id = $request->location;
                $gamedayentry->time = $request->input('date') . ' ' . $request->input('time') . ':00';
                $gamedayentry->notes = $request->input('notes');
                $gamedayentry->playercount_redundant = 0;
                $gamedayentry->save();
                $log = new Log();
                $log->description = "The gamedayentry with the id=" . $gamedayentry->id . " was created by user " . Auth::user()->name . ".";
                $log->description_idformat = "The gamedayentry with the id=" . $gamedayentry->id . " was created by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 5;
                $log->save();
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'Gamedays',
                    'paththumbnails'=>array("dashboard", "thumbs-up"),
                    'infomsg' => "Eistermindatensatz wurde erfolgreich erstellt.",
                    'infolvl' => "success",
                    'nexturl' => "/gamedays/" . $gamedayentry->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch ( \Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                $log = new Log();
                $log->description = "The gamedayentry could not be created by user " . Auth::user()->name . ".";
                $log->description_idformat = "The gamedayentry could not be created by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 5;
                $log->save();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'Gamedays',
                    'paththumbnails'=>array("dashboard", "thumbs-down"),
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
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Gamedays',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Eistermindatensatz erstellen zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    //this function updates the gamedayentry with the id $id from the db, based on the http-request
    public function update(Request $request, $id) {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                $gamedayentry = Gameday::find($id);
                $gamedayentry->location_id = $request->location;
                $gamedayentry->time = $request->input('date') . ' ' . $request->input('time') . ':00';
                $gamedayentry->notes = $request->input('notes');
                $gamedayentry->playercount_redundant = count($request->input('participantlist'));
                $gamedayentry->show_maxfplayersalert = $request->input('maxfplayersalert');
                $gamedayentry->show_maxgoaliesalert = $request->input('maxgoaliesalert');
                $userlist = $request->input('participantlist');
                $goalielist = $request->input('goalielist');
                if(!isset($goalielist)) {
                    $goalielist = array();
                }
                DB::table('gameday_user')->where('gameday_id', '=', $gamedayentry->id)->delete();
                $goaliecount = 0;
                for($i = 0; $i < count($userlist); $i++) {
                    $is_goalie = 0;
                    if(in_array($userlist[$i], $goalielist)) {
                        $is_goalie = 1;
                        $goaliecount++;
                    }
                    DB::table('gameday_user')->insert(
                        [
                            'user_id' => $userlist[$i],
                            'gameday_id' => $gamedayentry->id,
                            'is_goalie' => $is_goalie
                        ]);
                }
                $gamedayentry->goaliecount_redundant = $goaliecount;
                $gamedayentry->updated_at = \Carbon\Carbon::now();
                $gamedayentry->save();
                $log = new Log();
                $log->description = "The gamedayentry with the id=" . $gamedayentry->id . " was edited by user " . Auth::user()->name . ".";
                $log->description_idformat = "The gamedayentry with the id=" . $gamedayentry->id . " was edited by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 5;
                $log->save();
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'Gamedays',
                    'paththumbnails'=>array("dashboard", "thumbs-up"),
                    'infomsg' => "Eistermindatensatz wurde erfolgreich bearbeitet.",
                    'infolvl' => "success",
                    'nexturl' => "/gamedays/" . $gamedayentry->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch ( \Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                $log = new Log();
                $log->description = "The gamedayentry with the id=" . $id . " could not be edited by user " . Auth::user()->name . ".";
                $log->description_idformat = "The gamedayentry with the id=" . $id . " could not be edited by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 5;
                $log->save();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'Gamedays',
                    'paththumbnails'=>array("dashboard", "thumbs-down"),
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
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Gamedays',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Eistermindatensatz bearbeiten zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    //this function deletes the gamedayentry with the id $id from the db, based on the http-request
    public function destroy($id) {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                Gameday::destroy($id);
                $log = new Log();
                $log->description = "The gamedayentry with the id=" . $id . " was deleted by user " . Auth::user()->name . ".";
                $log->description_idformat = "The gamedayentry with the id=" . $id . " was deleted by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 5;
                $log->save();
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'Gamedays',
                    'paththumbnails'=>array("dashboard", "thumbs-up"),
                    'infomsg' => "Eistermindatensatz wurde erfolgreich gelöscht.",
                    'infolvl' => "success",
                    'nexturl' => "/gamedays",
                    'nexturldescription' => "Weiter"
                ]);
            } catch ( \Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                $log = new Log();
                $log->description = "The gamedayentry with the id=" . $id . " could not be deleted by user " . Auth::user()->name . ".";
                $log->description_idformat = "The gamedayentry with the id=" . $id . " could not be deleted by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 5;
                $log->save();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'Gamedays',
                    'paththumbnails'=>array("dashboard", "thumbs-down"),
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
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Gamedays',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Eistermindatensatz löschen zu können, müssen Sie die Rolle 'gamedaymanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }
}