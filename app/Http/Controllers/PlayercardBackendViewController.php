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