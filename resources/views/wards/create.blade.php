@extends('layout.default')

@section('title')
    Add New Ward To {!! $hospital->hospital_name !!}  @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('hospitals') !!}">Hospitals</a></li>
    <li><a href="{!! url('hospitals/'.$hospital->id) !!}">{!! $hospital->hospital_name !!}</a></li>
    <li>Add New Ward</li>
@endsection
@section('content')
    <div class="well">
        {!! Form::model(new App\Models\Ward,[
            'method' => 'POST',
            'route' => ['wards.store'],
            'class' => 'form-horizontal'
        ]) !!}

        {!! Form::hidden('hospital_id', $hospital->id) !!}
        <fieldset>
            <legend><h1>Add New Ward <span class="label label-info">{!! $hospital->hospital_name !!}</label></h1></legend>
            <div class="form-group">
                {!! Form::label('ward_name','Ward Name: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('ward_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('remark', 'Remark: ', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('remark', null, ['class' => 'form-control']) !!}
                </div>
            </div>         



        </fieldset>
        <div class="form-actions">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection