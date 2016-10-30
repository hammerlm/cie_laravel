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

class UserBackendViewController extends Controller
{
    public function index() {
        if (Gate::allows('manage-users') && Gate::allows('authenticate')) {
            $userlist = User::all();
            return view('templateslvlone.showuserlistbe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Benutzerübersicht"),
                'pagetitle' => "Spieltageübersicht",
                'userlist' => $userlist
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
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
                'pagetitle' => "Benutzererstellung"
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Benutzer erstellen zu können, müssen Sie die Rolle 'usermanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/team",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function edit($id)
    {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            return view('templateslvlone.editusersinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Benutzer","Benutzer bearbeiten"),
                'pagetitle' => "Benutzerbearbeitung",
                'userentry' => User::find($id)
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
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
                    if($request->input('password') == $request->input('password-confirm')) {
                        if($request->input('password') != "") {
                            $request->merge(['password' => Hash::make($request->input('password'))]);
                            $user = User::create($request->all());
                        } else {
                            return view('templateslvlone.backendinformationmessagepage')->with([
                                'user' => Auth::user(),
                                'path'=>array("Backend","Info"),
                                'pagetitle' => "Info",
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
                'infomsg' => "Um einen Benutzer erstellen zu können, müssen Sie die Rolle 'usermanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/team",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function update(Request $request, $id) {
        if (Gate::allows('manage-users') && Gate::allows('authenticate')) {
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
                'infomsg' => "Um einen Benutzer bearbeiten zu können, müssen Sie die Rolle 'usermanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/team",
                'nexturldescription' => "Weiter"
            ]);
        }
    }
}