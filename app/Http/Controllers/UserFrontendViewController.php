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

class UserFrontendViewController extends Controller
{
    public function index() {
        return view('templateslvlone.showusersfe')->with([
            'user' => Auth::user(),
            'path'=>array("Frontend","Team"),
            'pagetitle' => "Teamübersicht",
            'playercardlist' => User::where('show_playercard', '=', true)->get(),
            'userlist' => User::all()
        ]);
    }

    public function show($id) {
        return view('templateslvlone.showusersinglefe')->with([
            'user' => Auth::user(),
            'path'=>array("Frontend","Team"),
            'pagetitle' => "Teamübersicht",
            'userentry' => User::find($id)
        ]);
    }
}