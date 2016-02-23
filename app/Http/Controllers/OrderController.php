<?php

namespace App\Http\Controllers;

use App\DataTables\OrderHeaderDT;
use App\Models\OrderHeader;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Onhand;
use App\Models\ItemTransaction;

class OrderController extends Controller
{
    public function index(OrderHeaderDT $dataTable){
        $activeOrders = OrderHeader::latest()->get();
        return $dataTable->render('orders.index', compact('activeOrders'));
    }

    public function show($id){
        $order = OrderHeader::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function approve($id){
        $order = OrderHeader::findOrFail($id);
        $order->approved_by = Auth::user()->id;
        $order->approved_at = Carbon::now();
        if($order->save()) {
            return \Redirect::action('OrderController@show', ['id' => $order->id])->with('flash_message', 'Request is approved!');
        }else {
            return \Redirect::action('OrderController@show', ['id' => $order->id])->with('flash_message', 'Error!');
        }
    }

    public function reapprove($id){
        $order = OrderHeader::findOrFail($id);
        $order->approved_by = Auth::user()->id;
        $order->approved_at = Carbon::now();
        $order->cancelled_at = "0000-00-00 00:00:00";
        $order->delivering_at = "0000-00-00 00:00:00";




        if($order->save()) {
            return \Redirect::action('OrderController@show', ['id' => $order->id])->with('flash_message', 'Request is approved!');
        }else {
            return \Redirect::action('OrderController@show', ['id' => $order->id])->with('flash_message', 'Error!');
        }
    }

    public function deliver($id){
        $request = OrderHeader::findOrFail($id);


        DB::transaction(function() use ($request){

            $request->delivering_at = Carbon::now();
            $request->save();

            $items = $request->items;

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
                    'transaction_type' => 'deliver',
                    'note' => '',
                    'transfer_to' => $request->ordered_from,
                    'cost' => $item->cost,
                    'quantity' => 0-$item->quantity,
                    'created_by' => Auth::user()->id,
                    'hospital_id' => Auth::user()->hospital_id,
                    'order_no' => $request->id
                ]);
            }


        });

        return \Redirect::action('OrderController@show', ['id' => $request->id])->with('flash_message', 'Request is delivering!');

    }

    public function cancel($id){
        $order = OrderHeader::findOrFail($id);
        $order->cancelled_by = Auth::user()->id;
        $order->cancelled_at = Carbon::now();
        if($order->save()) {
            return \Redirect::action('OrderController@show', ['id' => $order->id])->with('flash_message', 'Request is cancelled!');
        }else {
            return \Redirect::action('OrderController@show', ['id' => $order->id])->with('flash_message', 'Error!');
        }
    }
}
