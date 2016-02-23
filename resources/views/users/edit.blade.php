@extends('layout.default')

@section('title')
    Edit User @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('users') !!}">Users</a></li>
    <li>Edit User - {!! $user->email !!}</li>
@endsection
@section('content')
    <div class="well">
        {!! Form::model($user,[
            'method' => 'PATCH',
            'route' => ['users.update', $user->id],
            'class' => 'form-horizontal'
        ]) !!}


            <fieldset>
                <legend><h1><strong>{!! $user->email !!}</strong> <small>Edit User</small></h1></legend>
                <div class="form-group">
                    {!! Form::label('email','Email: ',['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name', 'Name: ', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('role', 'Role', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::select('roles', $roles , (isset($user->roles->first()->id) ? $user->roles->first()->id : null) , ['class' => 'form-control']) !!}

                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('hospital_id', 'Hospital', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::select('hospital_id', $hospitals , null , ['class' => 'form-control']) !!}<p class="note">* Required</p>

                    </div>
                </div>
                </fieldset>
                <fieldset>
                <legend><p class="note"><strong>Optional</strong> ( leave blank if you do not wish to change your password )</p></legend>

                <div class="form-group">
                    {!! Form::label('password', 'Password: ', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Password Confirmation: ', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
                </div>

            </fieldset>
            <div class="form-actions">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection