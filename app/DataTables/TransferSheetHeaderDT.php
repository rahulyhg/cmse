<?php

namespace App\DataTables;

use App\Models\TransferSheetHeader;
use Yajra\Datatables\Services\DataTable;

class TransferSheetHeaderDT extends DataTable
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
                return $data->getStatus();
            })

            ->editColumn('created_by.name',function($data){
                return $data->createdBy ? $data->createdBy->name : 'n/a';
            })


            ->editColumn('created_at',function($data){
                return $data->created_at->format('d-m-Y');
            })
            ->editColumn('action',function($data){
                return "<a href='transfers/".$data->id."'><button><i class='glyphicon glyphicon-eye-open'></i></button></a>

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
        $users = TransferSheetHeader::with(['transferTo','createdBy']);
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
            ['data'=>'id','title'=>'Transfer Sheet No.','searchable'=>true,'orderable'=>true],
            ['data'=>'created_by.name', 'name'=>'createdBy.name', 'title'=>'Created By','searchable'=>true,'orderable'=>false],
            ['data'=>'transfer_to.hospital_name', 'name'=>'transferTo.hospital_name', 'title'=>'Transfer To','searchable'=>true,'orderable'=>false],
            ['data'=>'status','title'=>'Status','searchable'=>false,'orderable'=>false],
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
        return 'transfer_sheet';
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
