<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
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

    public function edit(Role $role)
    {
        return view('admin.roles.edit', ['role'=>$role, 'permissions'=>Permission::all()]);
    }


    public function update(Role $role)
    {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($role->isDirty('name')){
            $role->save();
            session()->flash('role-update', 'Updated role to >>' . $role->name . '<< !');
        } else{
            session()->flash('role-unchanged', 'Please enter a different Name than >>' . $role->name . '<< !');
        }
        return back();
    }

    public function attach_permission(Role $role)
    {
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach_permission(Role $role)
    {
        $role->permissions()->detach(request('permission'));
        return back();
    }

    public function destroy(Role $role)
    {
       $role->delete();
       session()->flash('role-delete', 'Deleted>>' . $role->name . '<<Role!' );
       return back();
    }
}
