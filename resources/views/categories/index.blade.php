@extends('layout.default')

@section('title')
    Categories @parent
@endsection

@section('breadcrumb')
    @parent
    <li>Categories</li>

@endsection

@section('content')

    <div class="well">
        <h1>Categories</h1>
        <hr>
        <a href="{!! url('categories/create') !!}" class="btn btn-labeled btn-primary">
         <span class="btn-label">
          <i class="glyphicon glyphicon-plus"></i>
         </span>
            Add New Category
        </a><br /><br />

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
            @foreach($cats as $id => $name)
                <tr>
                    <td>{!! $name !!}</td>
                    <td><a href="/categories/{!! $id !!}/edit">Edit</a></td>
                </tr>
            @endforeach
        </table>

    </div>

@endsection

@section('footer_scripts')

    <link rel="stylesheet" href="/css/buttons.dataTables.min.css">
    <script src="/vendor/datatables/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>


    <script>
        $('#dataTableBuilder').DataTable().on('click', '.btn-delete[data-remote]', function (e) {

            e.preventDefault();
            var url = $(this).data('remote');
            confirmation = confirm("Are you sure you wan to delete hospital?");
            if(confirmation) {
                // confirm then
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {method: '_DELETE'},
                    headers: {
                        'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                    },
                    error: function (xhr,a,b) {

                        alert(xhr.responseJSON.message);

                    }
                }).always(function (data) {
                    $('#dataTableBuilder').DataTable().draw(false);
                });
            }
        });
    </script>
@endsection