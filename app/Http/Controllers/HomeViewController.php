<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\News;

class HomeViewController extends Controller
{
    /**
     * Shows all recent news-contributions
     */
    public function index()
    {
        return view('templateslvlone.shownewslistfe')->with([
                'user' => Auth::user(),
                'path'=>array("Frontend","Home"),
                'pagetitle' => "Newsübersicht"
        ]);
    }
}