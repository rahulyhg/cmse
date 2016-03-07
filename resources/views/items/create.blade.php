@extends('layout.default')

@section('title')
    Add New Item @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('items') !!}">Items</a></li>
    <li>Add New Item</li>
@endsection
@section('content')
    <div class="well">
        {!! Form::model(new App\Models\Item,[
            'method' => 'POST',
            'route' => ['items.store'],
            'class' => 'form-horizontal'
        ]) !!}
        {!! csrf_field() !!}

        <fieldset>
            <legend><h1>Add New Item</h1></legend>
            <div class="form-group">
                {!! Form::label('item_code','Item Code: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('item_code', null, ['class' => 'form-control']) !!} <p class="note">* required</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('unit','Unit: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('unit', null, ['class' => 'form-control']) !!} <p class="note">* required</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('name','Item Name: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!} <p class="note">* required</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('category_id','Category: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('category_id', $categories , null , ['class' => 'form-control']) !!} <p class="note">* required</p>
                </div>
            </div>
        <hr>

            <div class="form-group">
                {!! Form::label('barcode','Barcode: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('barcode', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description: ', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('description', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <!--div class="form-group">
                {!! Form::label('cost','Item Cost: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('cost', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('gst_code', 'GST Code: ', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('gst_code', null, ['class' => 'form-control']) !!}

                </div>
            </div-->


        </fieldset>
        <div class="form-actions">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection