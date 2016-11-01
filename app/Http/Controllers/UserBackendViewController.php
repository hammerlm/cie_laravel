<?php

namespace App\Http\Controllers;

use App\User;
use App\Rolegroup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UserBackendViewController extends Controller
{
    public function index() {
        if (Gate::allows('authenticate')) {
            $userlist = User::all();
            return view('templateslvlone.showuserlistbe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Benutzerübersicht"),
                'pagetitle' => "Benutzerübersicht",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Team',
                'paththumbnails'=>array("dashboard", "star"),
                'userlist' => $userlist
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Team',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um die Benutzerliste im Verwaltungsbereich sehen zu können, müssen Sie die Rolle 'usermanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/team",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function create()
    {
        if (Gate::allows('manage-users') && Gate::allows('authenticate')) {
            return view('templateslvlone.createusersinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Benutzer","Benutzer erstellen"),
                'pagetitle' => "Benutzererstellung",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Team',
                'paththumbnails'=>array("dashboard", "star", "plus")
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Team',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Benutzer erstellen zu können, müssen Sie die Rolle 'usermanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/team",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function edit($id)
    {
        if ((Gate::allows('manage-users') || $id == Auth::user()->id) && Gate::allows('authenticate')) {
            return view('templateslvlone.editusersinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Benutzer","Benutzer bearbeiten"),
                'pagetitle' => "Benutzerbearbeitung",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Team',
                'paththumbnails'=>array("dashboard", "star", "pencil"),
                'userentry' => User::find($id),
                'rolegrouplist' => Rolegroup::all()
            ]);
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
                'nexturl' => "/gamedays",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('manage-users') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                if($request->input('email') != "" && $request->input('name') != "") {
                    if($request->input('password') == $request->input('password_confirmation')) {
                        if($request->input('password') != "") {
                            $request->merge(['password' => Hash::make($request->input('password'))]);
                            $user = User::create($request->all());
                        } else {
                            return view('templateslvlone.backendinformationmessagepage')->with([
                                'user' => Auth::user(),
                                'path'=>array("Backend","Info"),
                                'pagetitle' => "Info",
                                'selectedmenuitem_h' => 'Backend',
                                'selectedmenuitem_v' => 'Team',
                                'paththumbnails'=>array("dashboard", "thumbs-down"),
                                'infomsg' => "Das Passwort muss mindestens 1 Zeichen beinhalten.",
                                'infolvl' => "danger",
                                'nexturl' => "/backend/users/create",
                                'nexturldescription' => "Weiter"
                            ]);
                        }
                    }
                    else {
                        return view('templateslvlone.backendinformationmessagepage')->with([
                            'user' => Auth::user(),
                            'path'=>array("Backend","Info"),
                            'pagetitle' => "Info",
                            'selectedmenuitem_h' => 'Backend',
                            'selectedmenuitem_v' => 'Team',
                            'paththumbnails'=>array("dashboard", "thumbs-down"),
                            'infomsg' => "Die Passwörter stimmen nicht überein.",
                            'infolvl' => "danger",
                            'nexturl' => "/backend/users/create",
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
                        'infomsg' => "Bitte geben Sie einen Namen und eine E-Mail-Adresse ein.",
                        'infolvl' => "danger",
                        'nexturl' => "/backend/users/create",
                        'nexturldescription' => "Weiter"
                    ]);
                }
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'Team',
                    'paththumbnails'=>array("dashboard", "thumbs-up"),
                    'infomsg' => "Benutzer wurde erfolgreich erstellt",
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
                'infomsg' => "Um einen Benutzer erstellen zu können, müssen Sie die Rolle 'usermanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/team",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function update(Request $request, $id) {
        if ((Gate::allows('manage-users') || $id == Auth::user()->id) && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                $user = User::find($id);
                if($request->input('email') != "" && $request->input('name') != "") {
                    $user->email = $request->input('email');
                    $user->name = $request->input('name');
                    if($request->input('disable_account')) {
                        $user->is_disabled = 1;
                    } else {
                        $user->is_disabled = 0;
                    }
                    if($request->input('change_pw')) {
                        if($request->input('password') == $request->input('password-confirm')) {
                            if($request->input('password') != "") {
                                $request->merge(['password' => Hash::make($request->input('password'))]);
                                $user->password = $request->input('password');
                            } else {
                                return view('templateslvlone.backendinformationmessagepage')->with([
                                    'user' => Auth::user(),
                                    'path'=>array("Backend","Info"),
                                    'pagetitle' => "Info",
                                    'selectedmenuitem_h' => 'Backend',
                                    'selectedmenuitem_v' => 'Team',
                                    'paththumbnails'=>array("dashboard", "thumbs-down"),
                                    'infomsg' => "Das Passwort muss mindestens 1 Zeichen beinhalten.",
                                    'infolvl' => "danger",
                                    'nexturl' => "/backend/users/" . $id . "/edit",
                                    'nexturldescription' => "Weiter"
                                ]);
                            }
                        }
                        else {
                            return view('templateslvlone.backendinformationmessagepage')->with([
                                'user' => Auth::user(),
                                'path'=>array("Backend","Info"),
                                'pagetitle' => "Info",
                                'selectedmenuitem_h' => 'Backend',
                                'selectedmenuitem_v' => 'Team',
                                'paththumbnails'=>array("dashboard", "thumbs-down"),
                                'infomsg' => "Die Passwörter stimmen nicht überein.",
                                'infolvl' => "danger",
                                'nexturl' => "/backend/users/" . $id . "/edit",
                                'nexturldescription' => "Weiter"
                            ]);
                        }
                    }
                } else {
                    return view('templateslvlone.backendinformationmessagepage')->with([
                        'user' => Auth::user(),
                        'path'=>array("Backend","Info"),
                        'pagetitle' => "Info",
                        'selectedmenuitem_h' => 'Backend',
                        'selectedmenuitem_v' => 'Team',
                        'paththumbnails'=>array("dashboard", "thumbs-down"),
                        'infomsg' => "Bitte geben Sie einen Namen und eine E-Mail-Adresse ein.",
                        'infolvl' => "danger",
                        'nexturl' => "/backend/users/" . $id . "/edit",
                        'nexturldescription' => "Weiter"
                    ]);
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
                    'infomsg' => "Benutzer wurde erfolgreich bearbeitet.",
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