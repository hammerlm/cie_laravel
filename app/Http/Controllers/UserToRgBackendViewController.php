<?php

namespace App\Http\Controllers;

use App\User;
use App\Rolegroup;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Log;
use DB;

class UserToRgBackendViewController extends Controller
{
    //this function updates the user-to-rolegroup-relation-db-entries for the user with the id $id, based on the http-request
    public function update(Request $request, $id) {
        if (Gate::allows('manage-permissions') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                $userentry = User::find($id);
                $rolegrouplist = $request->input('rolegrouplist');
                DB::table('rolegroup_user')->where('user_id', '=', $userentry->id)->delete();
                for($i = 0; $i < count($rolegrouplist); $i++) {
                    $rg = Rolegroup::find($rolegrouplist[$i]);
                    $userentry->rolegroups()->attach($rg);
                }
                DB::commit();
                $log = new Log();
                $log->description = "The rolegroup-allocations for the user " . $userentry->name . " were edited by user " . Auth::user()->name . ".";
                $log->description_idformat = "The rolegroup-allocations for the user with id=" . $userentry->id . " were edited by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->affecteduser_id = $userentry->id;
                $log->logcategory_id = 4;
                $log->save();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'Team',
                    'paththumbnails'=>array("dashboard", "thumbs-up"),
                    'infomsg' => "Änderungen der Benutzer-zu-Rollengruppen-Zuteilungen wurden erfolgreich bearbeitet.",
                    'infolvl' => "success",
                    'nexturl' => "/users/" . $userentry->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                $log = new Log();
                $log->description = "The rolegroup-allocations for the user " . User::find($id)->name . " could not be edited by user " . Auth::user()->name . ".";
                $log->description_idformat = "The rolegroup-allocations for the user with id=" . $id . " could not be edited by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->affecteduser_id = $id;
                $log->logcategory_id = 4;
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
                'infomsg' => "Um die Autorisierungseinstellungen eines Benutzers bearbeiten zu können, müssen Sie die Rolle 'permissionmanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/team",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

}