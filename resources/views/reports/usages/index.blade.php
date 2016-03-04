@extends('layout.default')

@section('title')
   Usage Report @parent
@endsection

@section('breadcrumb')
    @parent
    <li>Usage Report</li>
@endsection

@section('content')
    <div class="well">
        <legend><h1>Usage Report</h1></legend>
        {!! Form::open(['route' => 'reports.usages.generate', 'method' => 'get', 'class' => 'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('hospital_id', 'Select Hospital', ['class' => 'control-label col-md-2']) !!}
            <div class="col-md-4">
                {!! Form::select('hospital_id', $hospitals , null , ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('type', 'Select Type', ['class' => 'control-label col-md-2']) !!}
            <div class="col-md-4">
                {!! Form::select('type',
                        [
                        'daily' => 'Daily',
                        'monthly' => 'Monthly',
                        ],
                        null ,
                        ['class' => 'form-control'])
                !!}
            </div>
        </div>


        {!! Form::close() !!}
    </div>

@endsection

@section('footer_scripts')

@endsection