<?php

namespace App\DataTables;

use App\Models\Ward;
use Yajra\Datatables\Services\DataTable;

class WardsDT extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected $hospital_id;

    public function setHospitalId($id){
        $this->hospital_id = $id;
    }


    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($wards) {
                return '<a href="/wards/'.$wards->id.'"><button><i class="glyphicon glyphicon-eye-open"></i></button></a> <a href="/wards/'.$wards->id.'/edit"><button><i class="glyphicon glyphicon-edit"></i></button></a> <button class="btn-delete" data-remote="/wards/'.$wards->id.'"><i class="glyphicon glyphicon-trash"></i></button> ';
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
        $wards = Ward::with('hospital')->where('hospital_id','=',$this->hospital_id)->select('*');

        return $this->applyScopes($wards);
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
                        'dom' => 'Bflrtip',
                        'buttons' => ['excel', 'pdf', 'reload'],
                        'lengthMenu' => [10, 25, 50]
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
            'id',
            'ward_name',
            'remark',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'wards';
    }
}
