<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;

class HomeViewController extends Controller
{
    /**
     * Shows all recent news-contributions
     */
    public function index()
    {
        if (Gate::allows('authenticate')) {
            echo "yes";
        }
        return view('templateslvlone.shownewslistfe');
    }
}