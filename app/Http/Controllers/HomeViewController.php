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
        $newslist = News::with('categories', 'creator')->orderBy('created_at', 'desc')->paginate(6);
        return view('templateslvlone.shownewslistfe')->with([
                'user' => Auth::user(),
                'path'=>array("Frontend","Home"),
                'pagetitle' => "Newsübersicht",
            'newslist' => $newslist
        ]);
    }

    /**
     * Shows the singleview of a newsentry
     */
    public function show($id) {
        $newsentry = News::find($id);
        return view('templateslvlone.shownewssinglefe')->with([
            'user' => Auth::user(),
            'path'=>array("Frontend","News","News-Einzelansicht"),
            'pagetitle' => "News-Einzelansicht",
            'newsentry' => $newsentry
        ]);
    }
}