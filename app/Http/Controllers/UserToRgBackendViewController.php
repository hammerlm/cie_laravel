<?php

namespace App\Http\Controllers;

use App\User;
use App\Rolegroup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UserToRgBackendViewController extends Controller
{
    public function update(Request $request, $id) {
        if (Gate::allows('manage-permissions') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                $userentry = User::find($id);
                $rolegrouplist = $request->input('rolegrouplist');
                DB::table('rolegroup_user')->where('user_id', '=', $userentry->id)->delete();
                for($i = 0; $i < count($rolegrouplist); $i++) {
                    $rg = Rolegroup::find($rolegrouplist[$i]);
                    $userentry->rolegroups()->attach($rg);
                }
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Änderungen der Rollengruppenzuteilungen wurden erfolgreich bearbeitet.",
                    'infolvl' => "success",
                    'nexturl' => "/users/" . $userentry->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch (\Exception $e) {

            }
        } else {

        }
    }

}