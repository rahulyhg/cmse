<?php

namespace App\DataTables;

use App\Models\OrderHeader;
use Yajra\Datatables\Services\DataTable;

class OrderHeaderDT extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'path.to.action.view')

            ->editColumn('status',function($data){
                $status = $data->getStatus();
                if($status == "cancelled")
                    return "Cancelled <a href='orders/".$data->id."/reapprove' class='btn btn-success btn-xs'>Re-approve Now</a>";

                if($status == "pending")
                    return "Pending <a href='orders/".$data->id."/approve' class='btn btn-success btn-xs'>Approve Now</a>";

                if($status == "approved")
                    return "Approved <a href='orders/".$data->id."/delivering' class='btn btn-success btn-xs'>Deliver Now</a>";

                if($status == "delivering")
                    return "Delivering";

                if($status == "received")
                    return "Received";
            })

            ->editColumn('approved_by.name',function($data){
                return $data->approvedBy ? $data->approvedBy->name : 'n/a';
            })

            ->editColumn('cancelled_by.name',function($data){
                return $data->cancelledBy ? $data->cancelledBy->name : 'n/a';
            })
            ->editColumn('created_at',function($data){
                return $data->created_at->format('d-m-Y');
            })
            ->editColumn('action',function($data){
                return "<a href='orders/".$data->id."'><button><i class='glyphicon glyphicon-eye-open'></i></button></a>

                ";
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $users = OrderHeader::with(['orderedFrom','orderBy','approvedBy','cancelledBy']);
        return $this->applyScopes($users);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '100px'])
                    ->parameters($this->getBuilderParameters())
                    ->parameters([

                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            ['data'=>'id','title'=>'Order No.','searchable'=>true,'orderable'=>true],
            ['data'=>'order_by.name', 'name'=>'orderBy.name', 'title'=>'Order By','searchable'=>true,'orderable'=>false],
            ['data'=>'ordered_from.hospital_name', 'name'=>'orderedFrom.hospital_name', 'title'=>'Ordered From','searchable'=>true,'orderable'=>false],
            ['data'=>'status','title'=>'Status','searchable'=>false,'orderable'=>false],
            ['data'=>'approved_by.name', 'name'=>'approvedBy.name', 'title'=>'Approved','searchable'=>true,'orderable'=>false],
            ['data'=>'cancelled_by.name','name'=>'cancelledBy.name', 'title'=>'Cancelled By','searchable'=>true,'orderable'=>false],
            ['data'=>'created_at','name'=>'created_at','title'=>'Requested At','searchable'=>false,'orderable'=>true],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'orders';
    }

    protected function compileRelationSearch($query, $relation, $column, $keyword)
    {
        $myQuery = clone $this->query;
        $myQuery->orWhereHas($relation, function ($q) use ($column, $keyword, $query) {
            $sql = $q->select($this->connection->raw('count(1)'))
                ->where($column, 'like', $keyword)
                ->toSql();
            $sql = "($sql) >= 1";
            $query->orWhereRaw($sql, [$keyword]);
        });
    }
}
