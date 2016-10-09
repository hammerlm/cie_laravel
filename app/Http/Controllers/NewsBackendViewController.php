<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\News;

class NewsBackendViewController extends Controller
{
    /**
     * Shows all recent news-contributions
     */
    public function create()
    {
        return view('templateslvlone.createnewssinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","News","Neuen Beitrag erstellen"),
                'pagetitle' => "Newserstellung"
        ]);
    }
}