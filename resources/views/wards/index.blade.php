@extends('layout.default')

@section('title')
    Wards in - {!! $hospital->hospital_name !!} @parent
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{!! url('hospitals') !!}">Hospitals</a></li>
    <li><a href="{!! url('hospitals/'.$hospital->id) !!}">{!! $hospital->hospital_name !!}</a></li>
    <li>Wards </li>
@endsection

@section('content')

    <div class="well">
        <legend><h1>Wards in <a href="hospitals/{!! $hospital->id !!}"><small>Hospital {!! $hospital->hospital_name !!}</small></a></h1></legend>

        <a href="{!! url('wards/create') !!}?hospital_id={!! $hospital->id !!}" class="btn btn-labeled btn-primary">
         <span class="btn-label">
          <i class="glyphicon glyphicon-plus"></i>
         </span>
            Add New Ward
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