<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //
    public function index()
    {
       return view('admin.permissions.index', ['permissions'=>Permission::all()]);
    }

    public function store()
    {
        request()->validate([
            'name'=> ['required'],
        ]);

        Permission::create([
            /// first letter capitalized
            'name'=>Str::ucfirst(request('name')),
            /// dash in between slug
            'slug'=>Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return back();
    }

    public function edit(Permission $permission)
    {
       return view('admin.permissions.edit', ['permission'=>$permission]);
    }

    public function update(Permission $permission)
    {
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($permission->isDirty('name')){
            $permission->save();
            session()->flash('permission-update', 'Updated role to >>' . $permission->name . '<< !');
        } else{
            session()->flash('permission-unchanged', 'Please enter a different Name than >>' . $permission->name . '<< !');
        }
        return back();
    }

    public function destroy(Permission $permission)
    {
       $permission->delete();
       session()->flash('permission-delete', 'Deleted '. $permission->name);
       return back();
    }
}
