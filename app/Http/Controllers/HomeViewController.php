<?php

namespace App\Http\Controllers;

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
        $lastnewsentryid = 0;
        if(count($newslist) > 0) {
            $lastnewsentryid = News::orderBy('created_at', 'desc')->first()->id;
        }
        return view('templateslvlone.shownewslistfe')->with([
                'user' => Auth::user(),
                'path'=>array("Home", "Newsübersicht"),
                'pagetitle' => "Newsübersicht",
                'selectedmenuitem_h' => 'Home',
                'paththumbnails'=>array("home", "th-list"),
                'nextgd' => \App\HelperClassCustom::getnextgameday(),
                'timedifftonextgd' => \App\HelperClassCustom::gettimedifferencecomparedtonow(\App\HelperClassCustom::getnextgameday()),
                'newslist' => $newslist,
                'lastnewsentryid' => $lastnewsentryid
        ]);
    }

    /**
     * Shows the singleview of a newsentry
     */
    public function show($id) {
        $newsentry = News::find($id);
        return view('templateslvlone.shownewssinglefe')->with([
            'user' => Auth::user(),
            'path'=>array("News","News-Einzelansicht"),
            'pagetitle' => "News-Einzelansicht",
            'selectedmenuitem_h' => 'Home',
            'paththumbnails'=>array("th-list", "comment"),
            'nextgd' => \App\HelperClassCustom::getnextgameday(),
            'timedifftonextgd' => \App\HelperClassCustom::gettimedifferencecomparedtonow(\App\HelperClassCustom::getnextgameday()),
            'newsentry' => $newsentry
        ]);
    }
}