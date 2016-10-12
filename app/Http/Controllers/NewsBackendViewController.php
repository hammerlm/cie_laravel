<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\News;
use App\Category;

class NewsBackendViewController extends Controller
{
    /**
     * Shows all recent news-contributions
     */
    public function create()
    {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {
            return view('templateslvlone.createnewssinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","News","Neuen Beitrag erstellen"),
                'pagetitle' => "Newserstellung",
                'categorylist' => Category::all()
            ]);
        } else {
            return view('templateslvlone.createnewssinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","News","Neuen Beitrag erstellen"),
                'pagetitle' => "Newserstellung",
                'errormsg' => "Um einen Newsbeitrag erstellen zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'errorlvl' => "danger"

            ]);
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {


        } else {
            return redirect('/home');
        }
    }
}