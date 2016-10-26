<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Gameday;
use App\Location;
use DB;

class GamedayFrontendViewController extends Controller
{
    public function index() {
        $gamedaylist = Gameday::with('locations', 'users')->orderBy('time', 'desc')->paginate(15);
        return view('templateslvlone.showgamedaylistfe')->with([
            'user' => Auth::user(),
            'path'=>array("Frontend","Home"),
            'pagetitle' => "Spieltageübersicht",
            'gamedaylist' => $gamedaylist
        ]);
    }

    public function create()
    {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {

        } else {

        }
    }

    public function edit($id)
    {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {

        } else {

        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {

        } else {

        }
    }

    public function update(Request $request, $id) {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {
            try {

            } catch ( Exception $e ){

            }
        } else {

        }
    }

    public function destroy($id) {
        if (Gate::allows('manage-gamedays') && Gate::allows('authenticate')) {

        } else {

        }
    }
}