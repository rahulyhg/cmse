@extends('layout.default')

@section('title')
    Item Profile @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('items') !!}">Items</a></li>
    <li>Item Profile - {!! $item->name !!}</li>
@endsection
@section('content')
    <div class="well">
        <h1><strong>{!! $item->name !!}</strong> <small>Item Profile</small></h1>
        <hr>
        <table class="table table-bordered">
            <tr>
                <td>Item Code: </td><td>{!! $item->item_code !!}</td>
            </tr>
            <tr>
                <td>Unit: </td><td>{!! $item->unit !!}</td>
            </tr>
            <tr>
                <td>Name: </td><td>{!! $item->name !!}</td>
            </tr>
            <tr>
                <td>Category: </td><td>{!! $item->category->name !!}</td>
            </tr>
            <tr>
                <td>Barcode: </td><td>{!! $item->barcode !!}</td>
            </tr>
            <tr>
                <td>Description: </td><td>{!! $item->description !!}</td>
            </tr>
            <tr>
                <td>Item Cost: </td><td>{!! $item->cost !!}</td>
            </tr>
            <tr>
                <td>GST Code: </td><td>{!! $item->gst_code !!}</td>
            </tr>
            <tr>
                <td>Created At: </td><td>{!! $item->created_at !!}</td>
            </tr>
        </table>

        <legend>Hospitals On Hand Balance Break Down</legend>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Hospitals</th>
                <th>On Hand Qty</th>
            </tr>

            <tr class="bg-color-lighten">
                <td>HQ</td><td>{!! $item->getHqOnHand() !!}</td>
            </tr>
            @foreach($item->onhand as $onhand)
                @if($onhand->hospital->isHQ() == false)
                    <tr>
                        <td>{!! $onhand->hospital->hospital_name !!}</td><td>{!! $onhand->onhand !!}</td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td class="text-align-right"><strong class="">Total</strong></td>
                <td>{!! $item->onhand->sum('onhand') !!}</td>
            </tr>
        </table>



        <div class="form-actions">
            <a href="{!! URL::action('ItemAdjustmentController@create',['id'=>$item->id]) !!}"><button class="btn btn-danger">Adjustment</button></a>
            <a href="{!! URL::action('ItemController@edit',['id'=>$item->id]) !!}"><button class="btn btn-primary">Edit Profile</button></a>
        </div>


    </div>

    <div class="well">
        <header class="row-seperator-header">Item Transactions</header>
        <hr>

        {!! $dataTable->table() !!}
    </div>
@endsection

@section('footer_scripts')
    <link rel="stylesheet" href="/css/buttons.dataTables.min.css">
    <script src="/vendor/datatables/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endsection


