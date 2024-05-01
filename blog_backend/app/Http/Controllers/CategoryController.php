<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('index', ['categories'=> Category::get()
    ]);
    }

    public function create()
    {
        return view('create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required',
            'description'=>'required'
        ]);

        $category =new Category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        $category->save();
        return back()->withSuccess('Category Created !!!');
    }

    public function edit($id)
    {
        //fetch data from db
        $category = Category::where('id',$id)->first();
        return view('edit', ['category' => $category]);

    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'slug'=>'required',
            'description'=>'required'
        ]);

        $category = Category::where('id',$id)->first();

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        $category->save();
        return back()->withSuccess('Category Updated !!!');

    }

    public function destroy($id)
    {
        $category = Category::where('id',$id)->first();
        $category->delete();
        return back()->withSuccess('Category Deleted !!!');
    }

    public function show($id)
    {
        $category = Category::where('id',$id)->first();
        return view('show', ['category'=>$category]);
    }
}

