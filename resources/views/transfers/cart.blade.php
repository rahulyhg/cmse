<div style="font-size: 2em;text-align:center;font-weight:bold;">Transfer List</div>
<br />
<?php $carts=\Cart::content() ?>
<?php $hospitals = App\Models\Hospital::NotHq()->lists('hospital_name','id') ?>
<table class="table table-striped table-bordered table-advance table-hover">
    <tr>
        <th>Item</th>
        <th style="width:50px;">Qty</th>
        <th style="width:20px;"></th>
    </tr>
    @foreach($carts as $cart)

    <tr>
        <td>
            <p><strong>#{!! $cart->id !!}</strong> <br /> <span class="note">{!! $cart->name !!}</span></p>
        </td>
        <td>{!! $cart->qty !!}</td>
        <td><a href="{!! url('cart/remove/'.$cart->rowid) !!}"><i class="del-cart-item-btn glyphicon glyphicon-remove-sign" style="cursor:pointer;" item="{!! $cart->rowid !!}" itemName="{!! $cart->name !!}"></i></a></td>

    </tr>


    @endforeach
</table>
{!! Form::open(['action' => 'TransferController@create', 'method' => 'post']) !!}
    {!! Form::label('trasfer_to', 'Transfer To :', ['class' => 'control-label']) !!}
	{!! Form::select('transfer_to', $hospitals , null , ['class' => 'form-control']) !!}
<br />
    {!! Form::submit('Process Transfer List', ['class' => 'form-control btn btn-primary']) !!}
{!! Form::close() !!}



<script>




</script>
