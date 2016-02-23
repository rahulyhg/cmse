@extends('layout.default')

@section('title')
    Edit Ward  @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('hospitals') !!}">Hospitals</a></li>
    <li><a href="{!! url('hospitals/'.$ward->hospital_id) !!}">{!! $ward->hospital->hospital_name !!}</a></li>
    <li><a href="{!! url('wards/'.$ward->id) !!}">Ward - {!! $ward->ward_name !!}</a></li>
    <li>Edit Ward</li>
@endsection
@section('content')
    <div class="well">
        {!! Form::model($ward,[
            'method' => 'PATCH',
            'route' => ['wards.update', $ward->id],
            'class' => 'form-horizontal'
        ]) !!}

        {!! Form::hidden('hospital_id') !!}
        <fieldset>
            <legend><h1>{!! $ward->ward_name !!} <small>Edit Ward</small></h1></legend>
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