@extends('layout.default')

@section('title')
    Add New Hospital @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('hospitals') !!}">Hospitals</a></li>
    <li>Add New Hospital</li>
@endsection
@section('content')
    <div class="well">
        {!! Form::model(new App\Models\Hospital,[
            'method' => 'POST',
            'route' => ['hospitals.store'],
            'class' => 'form-horizontal'
        ]) !!}
        {!! csrf_field(); !!}

        <fieldset>
            <legend><h1>Add New Hospital</h1></legend>
            <div class="form-group">
                {!! Form::label('hospital_name','Hospital Name: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('hospital_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('address', 'Address: ', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('remark', 'Remark: ', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}

                </div>
            </div>


        </fieldset>
        <div class="form-actions">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection