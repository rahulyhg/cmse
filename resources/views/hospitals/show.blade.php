@extends('layout.default')

@section('title')
    Hospital Profile @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('hospitals') !!}">Hospitals</a></li>
    <li>Hospital Profile - {!! $hospital->hospital_name !!}</li>
@endsection
@section('content')
    <div class="well">
        <h1><strong>{!! $hospital->hospital_name !!}</strong> <small>Hospital Profile</small></h1>
        <hr>
        <table class="table table-bordered">
            <tr>
                <td>ID: </td><td>{!! $hospital->id !!}</td>
            </tr>
            <tr>
                <td>Name: </td><td>{!! $hospital->hospital_name !!}</td>
            </tr>
            <tr>
                <td>Address: </td><td>{!! $hospital->address !!}</td>
            </tr>
            <tr>
                <td>Created At: </td><td>{!! $hospital->created_at !!}</td>
            </tr>
            <tr>
                <td>Wards: </td><td>
                    {!! $dataTable->table() !!}
                </td>
            </tr>
        </table>
        <div class="form-actions">
            <a href="{!! URL::action('HospitalController@edit',['id'=>$hospital->id]) !!}"><button class="btn btn-primary">Edit</button></a>
        </div>
    </div>
@endsection

@section('footer_scripts')

    <link rel="stylesheet" href="/css/buttons.dataTables.min.css">
    <script src="/vendor/datatables/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}

    <script>
        $('#dataTableBuilder').DataTable().on('click', '.btn-delete[data-remote]', function (e) {

            e.preventDefault();
            var url = $(this).data('remote');
            confirmation = confirm("Are you sure you wan to delete ward?");
            if(confirmation) {
                // confirm then
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {method: '_DELETE'},
                    headers: {
                        'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                    }
                }).always(function (data) {

                    $('#dataTableBuilder').DataTable().draw(false);
                });
            }
        });
    </script>
@endsection