@extends('layout.default')

@section('title')
    Edit Hospital @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('hospitals') !!}">Hospitals</a></li>
    <li><a href="{!! URL::action('HospitalController@show',['id' => $hospital->id]) !!}">{!! $hospital->hospital_name !!}</a></li>
    <li>Edit Hospital</li>
@endsection
@section('content')
    <div class="well">
        {!! Form::model($hospital,[
            'method' => 'PATCH',
            'route' => ['hospitals.update', $hospital->id],
            'class' => 'form-horizontal'
        ]) !!}


        <fieldset>
            <legend><h1>{!! $hospital->hospital_name !!} <small>Edit Hospital</small></h1></legend>
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
                {!! Form::label('remark', 'Remark', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}

                </div>
            </div>

        </fieldset>
        <div class="form-actions">
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection