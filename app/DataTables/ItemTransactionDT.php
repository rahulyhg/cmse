<?php

namespace App\DataTables;

use App\Models\ItemTransaction;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Services\DataTable;

class ItemTransactionDT extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';
    protected $itemCode;
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('created_at',function($data){
                return $data->created_at->format('d/m/Y');
            })
            ->editColumn('transfer_to',function($data){
                return $data->hospital ? $data->hospital->hospital_name : '';
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

        $users = ItemTransaction::where('item_code','=',$this->itemCode)
                                ->where('hospital_id','=',Auth::user()->hospital_id)
                                ->orderBy('created_at','desc');

        return $this->applyScopes($users);
    }

    public function setItemCode($itemCode){
        $this->itemCode = $itemCode;
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

                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'created_at',
            'transaction_type',
            'quantity',
            'transfer_to',
            'order_no'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'users';
    }
}
