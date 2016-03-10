<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function add(Request $request){
        $this->validate($request,[
            'quantity' => 'required|numeric|min:1',
        ]);

        $item = Item::where('item_code', '=', $request->input('item_code'))->first();

        Cart::add($request->input('item_code'),$item->name,$request->input('quantity'),$item->cost);

        return redirect()->back();

    }

    public function show()
    {
        return view('transfers.cart');
    }

    public function remove($id, Request $request)
    {
        Cart::remove($id);
        return redirect()->back();
    }




}
