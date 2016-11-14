<?php

namespace App\Http\Controllers;

use App\User;
use App\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use DB;

class LogBackendViewController extends Controller
{
    //this function shows all logentries in the db
    public function index() {
        if (Gate::allows('view-logs') && Gate::allows('authenticate')) {
            $loglist = Log::orderBy('created_at', 'desc')->paginate(15);
            return view('templateslvlone.showloglistbe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Logs"),
                'pagetitle' => "Logübersicht",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Logs',
                'paththumbnails'=>array("dashboard", "book"),
                'loglist' => $loglist
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'Team',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um Logeinträgen sehen zu können, müssen Sie die Rolle 'logviewer' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }
}