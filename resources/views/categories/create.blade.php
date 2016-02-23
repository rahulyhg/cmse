@extends('layout.default')

@section('title')
    Add New Category @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('categories') !!}">Categories</a></li>
    <li>Add New Category</li>
@endsection
@section('content')
    <div class="well">
        {!! Form::open([
            'method' => 'POST',
            'route' => ['categories.store'],
            'class' => 'form-horizontal'
        ]) !!}
        {!! csrf_field() !!}

        <fieldset>
            <legend><h1>Add New Category</h1></legend>
            <div class="form-group">
                {!! Form::label('name','Category Name: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!} <p class="note">* required</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('parent', 'Parent', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('parent', $parents , null , ['class' => 'form-control']) !!}

                </div>
            </div>


        </fieldset>
        <div class="form-actions">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection