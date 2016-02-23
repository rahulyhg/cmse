@extends('layout.default')

@section('title')
    User Profile @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('users') !!}">Users</a></li>
    <li>User Profile - {!! $user->email !!}</li>
@endsection

@section('content')
        <div class="well">
            <legend><h1><strong>{!! $user->email !!}</strong> <small>User Profile</small></h1></legend>

            <table class="table table-bordered">
                <tr>
                    <td>ID: </td><td>{!! $user->id !!}</td>
                </tr>
                <tr>
                    <td>Name: </td><td>{!! $user->name !!}</td>
                </tr>
                <tr>
                    <td>Email: </td><td>{!! $user->email !!}</td>
                </tr>
                <tr>
                    <td>Role: </td><td>{!! isset($user->roles->first()->name) ? $user->roles->first()->name : "n/a" !!}</td>
                </tr>
                <tr>
                    <td>Hospital: </td><td>{!! $user->hospital->hospital_name !!}</td>
                </tr>
                <tr>
                    <td>Created At: </td><td>{!! $user->created_at !!}</td>
                </tr>
            </table>
            <div class="form-actions">
                <a href="/users/{!! $user->id !!}/edit"><button class="btn btn-primary">Edit</button></a>
            </div>
        </div>
@endsection