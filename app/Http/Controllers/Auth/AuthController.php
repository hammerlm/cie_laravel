<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Log;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function authenticated() {
        $user = Auth::user();
        if($user->is_disabled) {
            return redirect('/logout');
        } else {
            $roles = [];
            session(['roles' => $roles]);
            $roles = $results = DB::select(
                DB::raw(
                    "select distinct r.id, r.name
from roles r inner join role_rolegroup rr on rr.role_id = r.id
inner join rolegroups rg on rr.rolegroup_id = rg.id
inner join rolegroup_user ru on ru.rolegroup_id = rg.id
inner join users u on u.id = ru.user_id
where ru.user_id = :userid"), array(
                'userid' => $user->id,
            ));
            session(['roles' => $roles]);
            $log = new Log();
            $log->description = "User " . Auth::user()->name . " logged in.";
            $log->description_idformat = "User with id=" . Auth::user()->id . " logged in.";
            $log->user_id = Auth::user()->id;
            $log->logcategory_id = 6;
            $log->save();
            return redirect('/home');
        }
    }
}
