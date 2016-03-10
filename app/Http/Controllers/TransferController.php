<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DataTables\ItemOrderListDT;
use App\Models\Category;
use Illuminate\Support\Facades\Input;
use Cart;
use App\Models\TransferSheetHeader;
use App\Models\TransferSheetDetail;
use Illuminate\Support\Facades\Auth;
use App\DataTables\TransferSheetHeaderDT;
use App\Models\Onhand;
use App\Models\ItemTransaction;

class TransferController extends Controller
{

    public function index(TransferSheetHeaderDT $dataTable){
        return $dataTable->render('transfers.index', compact('request'));
    }

    public function newtransfer(ItemOrderListDT $dataTable){
        $nodes = Category::defaultOrder()->get()->linkNodes();

        $categories = [];
        foreach ($nodes as $node){
            $categories += [$node->id => $node->stringPath('&ensp;')];
        }
        $categories = ['' => 'All'] + $categories;

        $category_id = Input::get('cat');
        $dataTable->setCategoryId($category_id);



        return $dataTable->render('transfers.newtransfer',compact('categories'));
    }

    public function create(Request $request){
        $carts = Cart::content();
        $hospital = Hospital::findOrFail($request->input('transfer_to'));


        return view('transfers.create',compact(['carts','hospital']));
    }

    public function show($id){
        $transferSheet = TransferSheetHeader::findOrFail($id);
        return view('transfers.show', compact('transferSheet'));
    }

    public function store(Request $request){

        $carts = Cart::content();
        $transferHeader = new TransferSheetHeader;

        \DB::transaction(function () use($request, $carts, $transferHeader){

            $transferHeader->created_by = Auth::user()->id;
            $transferHeader->transfer_to = $request->input('hospital_id');
            $transferHeader->notes = $request->input('note');
            $transferHeader->save();

            $hospital = Hospital::find($request->input('hospital_id'));

            foreach($carts as $cart){
                TransferSheetDetail::create([
                    'transfer_sheet_id' => $transferHeader->id,
                    'item_code' => $cart->id,
                    'quantity' => $cart->qty
                ]);
            }

            $items = $transferHeader->items;

            foreach($items as $item){
                $onhand = Onhand::where('item_code','=',$item->item_code)
                    ->where('hospital_id','=',Auth::user()->hospital_id)->first();

                if($onhand){
                    $onhand->decrement('onhand',$item->quantity);
                    $onhand->save();
                }else{
                    Onhand::create([
                        'hospital_id' => Auth::user()->hospital_id,
                        'item_code' => $item->item_code,
                        'onhand' => 0 - $item->quantity
                    ]);
                }



                ItemTransaction::create([
                    'item_code' => $item->item_code,
                    'transaction_type' => 'transfer',
                    'note' => 'Transfering to ' . $hospital->hospital_name,
                    'transfer_to' => $request->transfer_to,
                    'quantity' => 0-$item->quantity,
                    'created_by' => Auth::user()->id,
                    'hospital_id' => Auth::user()->hospital_id,
                    'transfer_sheet_id' => $transferHeader->id
                ]);
            }

        });

        Cart::destroy();

        return \Redirect::action('TransferController@show',['id' => $transferHeader->id])->with('flash_message','Transfer Processed!');

    }
}
