@extends('layout.default')

@section('title')
    Add New User @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('users') !!}">Users</a></li>
    <li>Add New User</li>
@endsection
@section('content')
    <div class="well">
        {!! Form::model(new App\User,[
            'method' => 'POST',
            'route' => ['users.store'],
            'class' => 'form-horizontal'
        ]) !!}


        <fieldset>
            <legend><h1>Add New User</h1></legend>
            <div class="form-group">
                {!! Form::label('email','Email: ',['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}<p class="note">* Required</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('name', 'Name: ', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}<p class="note">* Required</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('role', 'Role', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('roles', $roles , null , ['class' => 'form-control']) !!}<p class="note">* Required</p>

                </div>
            </div>

            <div class="form-group">
                {!! Form::label('hospital_id', 'Hospital', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::select('hospital_id', $hospitals , null , ['class' => 'form-control']) !!}<p class="note">* Required</p>

                </div>
            </div>


            <div class="form-group">
                {!! Form::label('password', 'Password: ', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::password('password', ['class' => 'form-control']) !!}<p class="note">* Required</p>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password_confirmation', 'Password Confirmation: ', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-10">
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}<p class="note">* Required</p>
               </div>
            </div>

        </fieldset>
        <div class="form-actions">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection