<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class PlayercardBackendViewController extends Controller
{
    //this function updates the userentry with the id $id from the db, based on the http-request
    public function update(Request $request, $id) {
        if (Gate::allows('manage-playercards') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                $user = User::find($id);
                if($request->input('show_pc')) {
                    $ca1 = $request->input('ca1');
                    $ca2 = $request->input('ca2');
                    $ca3 = $request->input('ca3');
                    $ca4 = $request->input('ca4');
                    if(is_numeric($ca1) && is_numeric($ca2) && is_numeric($ca3) && is_numeric($ca4)){
                        $user->customattribute1 = $ca1;
                        $user->customattribute2 = $ca2;
                        $user->customattribute3 = $ca3;
                        $user->customattribute4 = $ca4;
                        $user->show_playercard = 1;
                    } else {
                        return view('templateslvlone.backendinformationmessagepage')->with([
                            'user' => Auth::user(),
                            'path'=>array("Backend","Info"),
                            'pagetitle' => "Info",
                            'selectedmenuitem_h' => 'Backend',
                            'selectedmenuitem_v' => 'Team',
                            'paththumbnails'=>array("dashboard", "thumbs-down"),
                            'infomsg' => "Die eingegebenen Parameter passen nicht.",
                            'infolvl' => "danger",
                            'nexturl' => "/backend/users/" . $id . "/edit",
                            'nexturldescription' => "Weiter"
                        ]);
                    }
                } else {
                    $user->show_playercard = 0;
                }
                $user->save();
                $log = new Log();
                $log->description = "The playercardsettings of the user " . $user->name . " were edited by user " . Auth::user()->name . ".";
                $log->description_idformat = "The playercardsettings of the user with id=" . $user->id . " were edited by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->affecteduser_id = $user->id;
                $log->logcategory_id = 2;
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'Team',
                    'paththumbnails'=>array("dashboard", "thumbs-up"),
                    'infomsg' => "Benutzer wurde erfolgreich bearbeitet",
                    'infolvl' => "success",
                    'nexturl' => "/users/" . $user->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch ( \Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                $log = new Log();
                $log->description = "The playercardsettings of the user " . User::find($id)->name . " could not be edited by user " . Auth::user()->name . ".";
                $log->description_idformat = "The playercardsettings of the user with id=" . $id . " could not be edited by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->affecteduser_id = $id;
                $log->logcategory_id = 2;
                $log->save();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'Team',
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
                'selectedmenuitem_v' => 'Team',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Benutzer bearbeiten zu können, müssen Sie die Rolle 'usermanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/team",
                'nexturldescription' => "Weiter"
            ]);
        }
    }
}