<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\News;
use App\Category;
use DB;

class NewsBackendViewController extends Controller
{
    public function index() {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {

            $newslist = News::orderBy('created_at', 'desc')->paginate(15);
            return view('templateslvlone.shownewslistbe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Newsübersicht"),
                'pagetitle' => "Newsübersicht",
                'newslist' => $newslist
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um diesen Bereich sehen zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }
    /**
     * Shows the Newsentrycreationpage
     */
    public function create()
    {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {

            return view('templateslvlone.createnewssinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","News","Newseintrag erstellen"),
                'pagetitle' => "Newserstellung",
                'categorylist' => Category::all()
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Newsbeitrag erstellen zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    /**
     * Shows the Newsentrymodificationpage
     */
    public function edit($id)
    {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {
            return view('templateslvlone.editnewssinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","News","Newseintrag bearbeiten"),
                'pagetitle' => "Newsbearbeitung",
                'categorylist' => Category::all(),
                'newsentry' => News::find($id)
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Newsbeitrag bearbeiten zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                $newsentry = new News();
                $newsentry->title = $request->input('title');
                $newsentry->body = $request->input('body');
                $newsentry->creator_id = Auth::user()->id;
                $newsentry->modifier_id = Auth::user()->id;
                $newsentry->save();
                $categorylist = $request->input('categorylist');
                for($i = 0; $i < count($categorylist); $i++) {
                    $category = Category::find($categorylist[$i]);
                    $newsentry->categories()->attach($category);
                }
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Newsbeitrag wurde erfolgreich erstellt",
                    'infolvl' => "success",
                    'nexturl' => "/news/" . $newsentry->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Sorry, es ist ein Fehler aufgetreten: " . $e->getMessage(),
                    'infolvl' => "danger",
                    'nexturl' => "/home",
                    'nexturldescription' => "Weiter"
                ]);
            }
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Newsbeitrag erstellen zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "danger",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function update(Request $request, $id) {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                $newsentry = News::find($id);
                $newsentry->title = $request->input('title');
                $newsentry->body = $request->input('body');
                $newsentry->modifier_id = Auth::user()->id;
                $newsentry->save();
                $categorylist = $request->input('categorylist');
                DB::table('category_news')->where('news_id', '=', $newsentry->id)->delete();
                for($i = 0; $i < count($categorylist); $i++) {
                    $category = Category::find($categorylist[$i]);
                    $newsentry->categories()->attach($category);
                }
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Newsbeitrag wurde erfolgreich bearbeitet",
                    'infolvl' => "success",
                    'nexturl' => "/news/" . $newsentry->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Sorry, es ist ein Fehler aufgetreten: " . $e->getMessage(),
                    'infolvl' => "danger",
                    'nexturl' => "/home",
                    'nexturldescription' => "Weiter"
                ]);
            }
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Newsbeitrag bearbeiten zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "danger",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    public function destroy($id) {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                News::destroy($id);
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Newsbeitrag wurde erfolgreich gelöscht!",
                    'infolvl' => "success",
                    'nexturl' => "/home/",
                    'nexturldescription' => "Weiter"
                ]);
            } catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'infomsg' => "Sorry, es ist ein Fehler aufgetreten: " . $e->getMessage(),
                    'infolvl' => "danger",
                    'nexturl' => "/home",
                    'nexturldescription' => "Weiter"
                ]);
            }
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'infomsg' => "Um einen Newsbeitrag löschen zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "danger",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }
}