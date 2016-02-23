@extends('../layout/default')

@section('title')
    Users @parent
@endsection

@section('breadcrumb')
    @parent
    <li>Users</li>
@endsection

@section('content')



        @include('flash::message')


            <h1 class="pull-left">User List</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('users.create') !!}">Add New</a>



            @if($users->isEmpty())
                <div class="well text-center">No Users found.</div>
            @else
                @include('users.table')
            @endif


        @include('common.paginate', ['records' => $users])



@endsection


@section('footer_scripts')
    <script src="/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="/js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
@endsection
