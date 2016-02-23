@extends('layout.default')

@section('title')
    Ward Profile - {!! $ward->hospital->hospital_name !!} @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('hospitals') !!}">Hospitals</a></li>
    <li><a href="{!! url('hospitals/'.$ward->hospital_id) !!}">{!! $ward->hospital->hospital_name !!}</a></li>
    <li>Ward Profile - {!! $ward->ward_name !!} </li>
@endsection
@section('content')
    <div class="well">
        <h1><strong>{!! $ward->ward_name !!}</strong> <small>Ward Profile</small></h1>
        <hr>
        <table class="table table-bordered">
            <tr>
                <td>ID: </td><td>{!! $ward->id !!}</td>
            </tr>
            <tr>
                <td>Name: </td><td>{!! $ward->ward_name !!}</td>
            </tr>
            <tr>
                <td>Remark: </td><td>{!! $ward->remark !!}</td>
            </tr>
            <tr>
                <td>Created At: </td><td>{!! $ward->created_at !!}</td>
            </tr>
            <tr>
                <td>At Hospital: </td><td>{!! $ward->hospital->hospital_name !!}</td>
            </tr>
        </table>

        <div class="form-actions">
            <a href="{!! URL::action('WardController@edit',['id' => $ward->id]) !!}"><button class="btn btn-primary">Edit</button></a>
        </div>
    </div>
@endsection