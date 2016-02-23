<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDT;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Category;
use Kalnoy\Nestedset\NestedSet;

class CategoryController extends Controller
{
    public function index(){
        $nodes = Category::defaultOrder()->get()->linkNodes();

        $cats = [];
        foreach ($nodes as $node){
            $cats += [$node->id => $node->stringPath('&mdash; ')];
        }

        return view('categories.index',compact('cats'));
    }

    public function create(){

        $nodes = Category::defaultOrder()->get()->linkNodes();

        $parents = ['' => 'None'];
        foreach ($nodes as $node){
            $parents += [$node->id => $node->stringPath('&ensp;')];
        }

        return view('categories.create',compact('parents'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
        ]);

        if($request->input('parent') == ''){
            Category::create(['name'=>$request->input('name')]);
        }else{
            $parent = Category::findOrFail($request->input('parent'));
            Category::create(['name'=>$request->input('name')],$parent);
        }

        return \Redirect::back()->with('flash_message', 'Category successfully created!');

    }

    public function edit($id){

        $nodes = Category::defaultOrder()->get()->linkNodes();

        $parents = ['' => 'None'];
        foreach ($nodes as $node){
            $parents += [$node->id => $node->stringPath('&ensp;')];
        }

        $cat = Category::findOrFail($id);
        return view('categories.edit',compact(['cat','parents']));
    }

    public function update($id, Request $request){
        $this->validate($request,[
            'name' => 'required',
        ]);

        $cat = Category::findOrFail($id);
        $cat->name = $request->input('name');
        if($request->input('parent') == ''){
            $cat->makeRoot();
        }else{
            $cat->parent_id = $request->input('parent');
        }
        $cat->save();

        return \Redirect::back()->with('flash_message', 'Category successfully updated!');

    }

}
