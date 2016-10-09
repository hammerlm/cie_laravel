<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class HomeViewController extends Controller
{
    /**
     * Shows all recent news-contributions
     */
    public function index()
    {
        return view('templates_lvl1.shownewslistfe');
    }
}