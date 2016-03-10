@extends('layout.default')

@section('title')
   View Transfer @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('transfers') !!}">Transfers</a></li>
    <li>View Transfer {!! $transferSheet->id !!}</li>
@endsection

@section('content')
    <div class="well">
        <h1>View Transfer #{!! $transferSheet->id !!}</h1>
        <hr>
        <div class="row">
            <div class="col-md-2 text-align-right">Transfer No. :</div>
            <div class="col-md-10">
                {!! $transferSheet->id !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 text-align-right">Created By :</div>
            <div class="col-md-10">
                {!! $transferSheet->createdBy->name !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 text-align-right">Transfer To :</div>
            <div class="col-md-10">
                {!! $transferSheet->transferTo->hospital_name !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 text-align-right">Status :</div>
            <div class="col-md-10">
                {!! $transferSheet->getStatus() !!}
            </div>
        </div>



        <div class="row">
            <div class="col-md-2 text-align-right">Received By :</div>
            <div class="col-md-10">
                {!! $transferSheet->receivedBy ? $transferSheet->receivedBy->name : 'n/a' !!}
            </div>
        </div>

        <table class="table dataTable table-bordered table-striped table-hover">
            <tr>
                <th>No.</th>
                <th>Item Code</th>
                <th>Quantity</th>
            </tr>
            <?php $c=0 ?>
            @foreach($transferSheet->items as $item)
                <?php $c++ ?>
                <tr>
                    <td>{!! $c !!}</td>
                    <td>{!! $item->item_code !!}</td>
                    <td>{!! $item->quantity !!}</td>
                </tr>
            @endforeach
        </table>
        <p class="note">* Status will be mark as received when the Transfer is set to received at the destination</p>
        <br />
        Notes / Instruction:
        <div class="well">
            {!! $transferSheet->notes !!}
        </div>



    </div>







@endsection

@section('footer_scripts')

@endsection