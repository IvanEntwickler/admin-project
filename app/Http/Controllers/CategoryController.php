<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index(){
        return view('admin.categories.index',['categories'=>Category::all()]);
    }

    public function store()
    {
        request()->validate([
            'name'=> ['required'],
        ]);

        Category::create([
            /// first letter capitalized
            'name'=>Str::ucfirst(request('name')),
        ]);

        return back();
    }

    public function edit(Category $category)
    {

        return view('admin.categories.edit', ['category'=>$category,'categories'=>Category::all()]);
    }

    public function update(Category $category)
    {
        $category->name = Str::ucfirst(request('name'));

        if($category->isDirty('name')){
            $category->save();
            session()->flash('category-update', 'Updated category to >>' . $category->name . '<< !');
        } else{
            session()->flash('category-unchanged', 'Please enter a different Name than >>' . $category->name . '<< !');
        }
        return back();
    }

    public function destroy(Category $category)
    {
       $category->delete();
       session()->flash('category-delete', 'Deleted>>' . $category->name . '<<Category!' );
       return back();
    }

}
