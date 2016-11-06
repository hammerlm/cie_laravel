<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\News;
use App\Category;
use App\Log;
use DB;

class NewsBackendViewController extends Controller
{
    //this function returns all newsentries from the db and packs it into the shownewslistbe-view
    public function index() {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {

            $newslist = News::orderBy('created_at', 'desc')->paginate(15);
            return view('templateslvlone.shownewslistbe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","News"),
                'pagetitle' => "Newsübersicht",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'News',
                'paththumbnails'=>array("dashboard", "th-list"),
                'newslist' => $newslist
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'News',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um diesen Bereich sehen zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    //this function returns the creation-view for newsentries
    public function create()
    {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {

            return view('templateslvlone.createnewssinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","News","Newseintrag erstellen"),
                'pagetitle' => "Newserstellung",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'News',
                'paththumbnails'=>array("dashboard", "th-list", "plus"),
                'categorylist' => Category::all()
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'News',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Newsbeitrag erstellen zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    //this function returns the edit-view for newsentries
    public function edit($id)
    {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {
            return view('templateslvlone.editnewssinglebe')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","News","Newseintrag bearbeiten"),
                'pagetitle' => "Newsbearbeitung",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'News',
                'paththumbnails'=>array("dashboard", "th-list", "pencil"),
                'categorylist' => Category::all(),
                'newsentry' => News::find($id)
            ]);
        } else {
            return view('templateslvlone.backendinformationmessagepage')->with([
                'user' => Auth::user(),
                'path'=>array("Backend","Info"),
                'pagetitle' => "Info",
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'News',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Newsbeitrag bearbeiten zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "warning",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    //this function stores a newsentry into the db, based on the http-request
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
                $log = new Log();
                $log->description = "The newsentry with the id=" . $newsentry->id . " was created by user " . Auth::user()->name . ".";
                $log->description_idformat = "The newsentry with the id=" . $newsentry->id . " was created by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 1;
                $log->save();
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'News',
                    'paththumbnails'=>array("dashboard", "thumbs-up"),
                    'infomsg' => "Newsbeitrag wurde erfolgreich erstellt",
                    'infolvl' => "success",
                    'nexturl' => "/news/" . $newsentry->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch ( \Exception $e ){
                //If there are any exceptions, rollback the transaction
                $log = new Log();
                $log->description = "The newsentry could not be created by user " . Auth::user()->name . ".";
                $log->description_idformat = "The newsentry could not be created by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 1;
                $log->save();
                DB::rollback();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'News',
                    'paththumbnails'=>array("dashboard", "thumbs-down"),
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
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'News',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Newsbeitrag erstellen zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "danger",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    //this function updates the newsentry with the id $id from the db, based on the http-request
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
                $log = new Log();
                $log->description = "The newsentry with the id=" . $newsentry->id . " was edited by user " . Auth::user()->name . ".";
                $log->description_idformat = "The newsentry with the id=" . $newsentry->id . " was edited by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 1;
                $log->save();
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'News',
                    'paththumbnails'=>array("dashboard", "thumbs-up"),
                    'infomsg' => "Newsbeitrag wurde erfolgreich bearbeitet",
                    'infolvl' => "success",
                    'nexturl' => "/news/" . $newsentry->id,
                    'nexturldescription' => "Weiter zur Einzelansicht"
                ]);
            } catch ( \Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                $log = new Log();
                $log->description = "The newsentry with the id=" . $id . " could not be edited by user " . Auth::user()->name . ".";
                $log->description_idformat = "The newsentry with the id=" . $id . " could not be edited by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 1;
                $log->save();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'News',
                    'paththumbnails'=>array("dashboard", "thumbs-down"),
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
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'News',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Newsbeitrag bearbeiten zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "danger",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }

    //this function deletes the newsentry with the id $id from the db, based on the http-request
    public function destroy($id) {
        if (Gate::allows('manage-news') && Gate::allows('authenticate')) {
            try {
                DB::beginTransaction();
                News::destroy($id);
                $log = new Log();
                $log->description = "The newsentry with the id=" . $id . " was deleted by user " . Auth::user()->name . ".";
                $log->description_idformat = "The newsentry with the id=" . $id . " was deleted by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 1;
                $log->save();
                DB::commit();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'News',
                    'paththumbnails'=>array("dashboard", "thumbs-up"),
                    'infomsg' => "Newsbeitrag wurde erfolgreich gelöscht!",
                    'infolvl' => "success",
                    'nexturl' => "/home/",
                    'nexturldescription' => "Weiter"
                ]);
            } catch ( \Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                $log = new Log();
                $log->description = "The newsentry with the id=" . $id . " could not be deleted by user " . Auth::user()->name . ".";
                $log->description_idformat = "The newsentry with the id=" . $id . " could not be deleted by the user with id=" . Auth::user()->id . ".";
                $log->user_id = Auth::user()->id;
                $log->logcategory_id = 1;
                $log->save();
                return view('templateslvlone.backendinformationmessagepage')->with([
                    'user' => Auth::user(),
                    'path'=>array("Backend","Info"),
                    'pagetitle' => "Info",
                    'selectedmenuitem_h' => 'Backend',
                    'selectedmenuitem_v' => 'News',
                    'paththumbnails'=>array("dashboard", "thumbs-down"),
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
                'selectedmenuitem_h' => 'Backend',
                'selectedmenuitem_v' => 'News',
                'paththumbnails'=>array("dashboard", "thumbs-down"),
                'infomsg' => "Um einen Newsbeitrag löschen zu können, müssen Sie die Rolle 'newsmanager' zugeteilt haben!",
                'infolvl' => "danger",
                'nexturl' => "/home",
                'nexturldescription' => "Weiter"
            ]);
        }
    }
}