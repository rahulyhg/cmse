@extends('layout.default')

@section('title')
    Confirm Transfer @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! action('TransferController@index') !!}">Transfers</a></li>
    <li>Confirm Transfer</li>
@endsection

@section('content')
    <div class="well">
        <h1>Confirm Transfer</h1>
        <hr>
        <div class="well bg-color-lighten font-lg">Transfer To: <b class="txt-color-red">{!! $hospital->hospital_name !!}</b></div>
        <br />
        <label class="label label-primary">Transfer List</label>
    <table class="table-striped table-bordered dataTable table-hover">
        <tr>
            <th>No. </th>
            <th>Item Code</th>
            <th>Name</th>
            <th>Quantity</th>
        </tr>
        <?php $c=0 ?>
        @foreach($carts as $cart)
            <?php $c++ ?>
            <tr>
                <td>{!! $c !!}</td>
                <td>{!! $cart->id !!}</td>
                <td>{!! $cart->name !!}</td>
                <td>{!! $cart->qty !!}</td>
            </tr>
        @endforeach

    </table>
        <br />

        {!! Form::open(['route' => 'transfers.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::hidden('hospital_id', $hospital->id, ['id' => 'id']) !!}
        {!! Form::label('note', 'Notes / Instructions: ', ['class' => 'control-label']) !!}
        {!! Form::textarea('note', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-send"> </i> Confirm Transfer</button>
        {!! Form::close() !!}
        </div>
        <br /><br />
    </div>

@endsection