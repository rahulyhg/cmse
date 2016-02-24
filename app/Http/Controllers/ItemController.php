<?php

namespace App\Http\Controllers;

use App\DataTables\ItemDT;
use App\DataTables\ItemTransactionDT;
use App\Models\Item;
use App\Models\ItemTransaction;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Input;

class ItemController extends Controller
{
    public function index(ItemDT $dataTable){
        $nodes = Category::defaultOrder()->get()->linkNodes();

        $categories = [];
        foreach ($nodes as $node){
            $categories += [$node->id => $node->stringPath('&ensp;')];
        }
        $categories = ['' => 'All'] + $categories;

        $category_id = Input::get('cat');
        $dataTable->setCategoryId($category_id);

        return $dataTable->render('items.index',compact('categories'));
    }

    public function create(){
        $nodes = Category::defaultOrder()->get()->linkNodes();

        $categories = ['' => 'Please select one...'];
        foreach ($nodes as $node){
            $categories += [$node->id => $node->stringPath('&ensp;')];
        }

        return view('items.create', compact('categories'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'item_code' => 'required|min:3|unique:items',
            'unit' => 'required',
            'name' => 'required',
            'cost' => 'numeric',
            'category_id' => 'required'
        ]);

        $input = $request->all();
        $input['created_by'] = Auth::getUser()->id;
        $item = Item::create( $input );

        return \Redirect::route('items.show',$item->id)->with('flash_message', 'Item successfully created! <a href="'.url('items/create').'">Add More</a>');
    }

    public function show($id, ItemTransactionDT $dataTable){

        $item = Item::with('onhand')->findOrFail($id);

        $dataTable->setItemCode($item->item_code);

        return $dataTable->render('items.show',compact('item'));
    }

    public function destroy($id){
        $item = Item::findOrFail($id);
        if(Item::destroy($id)){

            $item->deleted_by = Auth::getUser()->id;
            $item->save();
        }
    }

    public function edit($id){
        $nodes = Category::defaultOrder()->get()->linkNodes();

        $categories = ['' => 'Please select one...'];
        foreach ($nodes as $node){
            $categories += [$node->id => $node->stringPath('&ensp;')];
        }

        $item = Item::findOrFail($id);

        return view('items.edit',compact(['item','categories']));
    }

    public function update($id, Request $request){
        $item = Item::findOrFail($id);
        $this->validate($request,[
            'item_code' => 'required|min:3|unique:items,item_code,'.$id,
            'unit' => 'required',
            'name' => 'required',
            'cost' => 'numeric'
        ]);

        $input = $request->all();
        $input['updated_by'] = Auth::getUser()->id;
        $item->fill( $input )->save();

        return \Redirect::route('items.show',$item->id)->with('flash_message', 'Item successfully updated!');
    }
}
