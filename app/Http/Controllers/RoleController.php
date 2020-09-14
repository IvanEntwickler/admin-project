<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //
    public function index()
    {
       return view('admin.roles.index', ['roles'=>Role::all()]);
    }

    public function store()
    {
        request()->validate([
            'name'=> ['required'],
        ]);

        Role::create([
            /// first letter capitalized
            'name'=>Str::ucfirst(request('name')),
            /// dash in between slug
            'slug'=>Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return back();
    }

    public function destroy(Role $role)
    {
       $role->delete();
       session()->flash('role-delete', 'Deleted>>' . $role->name . '<<Role!' );
       return back();
    }
}
