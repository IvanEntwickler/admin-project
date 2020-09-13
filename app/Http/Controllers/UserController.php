<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    //////// INDEX
    public function index(){
        $users = User::all();
        return view('admin.users.index', ['users'=>$users]);
    }

    //////// SHOW
    public function show(User $user){
        return view('admin.users.profile',
        ['user'=>$user, 'roles'=>Role::all()]
    );
    }

    //////// UPDATE
    public function update(User $user){

        $inputs = request()->validate([
            'username'=>['required', 'string', 'max:255', 'alpha_dash'],
            'name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'max:255'],
            // 'password'=>['min:6', 'max:255','confirmed'],
            'avatar'=>['file']
        ]);

        if(request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);

        return back();

    }

    /// DELETE
    public function destroy(Request $request, User $user){
        $user->delete();
        // prints out a message once the user was deleted
        $request->session()->flash('message', 'User >> ' . $user->name . ' << was successfully deleted!');
        // Session::flash('message', 'User at Id ' . $user->id . ' was successfully deleted!');
        return back();
    }

    /// Attach Roles

    public function attach(User $user){
        $user->roles()->attach(request('role'));

        return back();
    }

    /// Detach Roles

    public function detach(User $user){
        $user->roles()->detach(request('role'));

        return back();
    }

}
