@extends('layout.default')

@section('breadcrumb')
    @parent
    <li><a href="{!! url('users') !!}">Users</a></li>
    <li>Editing user account {!! $user->email !!}</li>
@endsection

@section('content')
<div class="container">

    @include('common.errors')
            <!-- NEW COL START -->
    <article class="col-sm-12 col-md-12 col-lg-6">
            <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
        <!-- widget options:
        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

        data-widget-colorbutton="false"
        data-widget-editbutton="false"
        data-widget-togglebutton="false"
        data-widget-deletebutton="false"
        data-widget-fullscreenbutton="false"
        data-widget-custombutton="false"
        data-widget-collapsed="true"
        data-widget-sortable="false"

        -->
        <header>
            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>Edit User Details </h2>

        </header>

            <!-- widget div-->
        <div>

        <!-- widget edit box -->
        <div class="jarviswidget-editbox">
            <!-- This area used as dropdown edit box -->

        </div>
        <!-- end widget edit box -->

        <!-- widget content -->
        <div class="widget-body no-padding">



    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch', 'class' => 'smart-form']) !!}
            <header>User ID: <span style="color:green">{!! $user->id !!}</span></header>
        @include('users.fields')

    {!! Form::close() !!}
    </div>
        </div>
        </div>
        </article>
</div>

@endsection
