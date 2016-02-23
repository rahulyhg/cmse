@extends('layout.default')

@section('title')
    Edit Category @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('categories') !!}">Categories</a></li>
    <li>Edit Category - {!! $cat->name !!}</li>
@endsection
@section('content')
    <div class="well">
        {!! Form::open([
            'method' => 'PATCH',
            'route' => ['categories.update',$cat->id],
            'class' => 'form-horizontal'
        ]) !!}
        {!! csrf_field() !!}

        <fieldset>
            <legend><h1>Edit New Category</h1></legend>
            <div class="form-group">
                {!! Form::label('name','Category Name: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('name', $cat->name, ['class' => 'form-control']) !!} <p class="note">* required</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('parent', 'Parent', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('parent', $parents , $cat->parent_id , ['class' => 'form-control']) !!}

                </div>
            </div>


        </fieldset>
        <div class="form-actions">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection