@extends('layout.default')

@section('title')
    Users @parent
@endsection

@section('breadcrumb')
    @parent
    <li>Users</li>
@endsection

@section('content')

    <div class="well">
        <h1>Users</h1>
        <hr>
        <a href="{!! url('users/create') !!}" class="btn btn-labeled btn-primary">
         <span class="btn-label">
          <i class="glyphicon glyphicon-plus"></i>
         </span>
            Add New User
        </a>
        <br /><br />
        {!! $dataTable->table() !!}

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
            confirmation = confirm("Are you sure you wan to delete user?");
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