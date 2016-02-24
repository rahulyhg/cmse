<?php

namespace App\DataTables;

use App\Models\Hospital;
use Yajra\Datatables\Services\DataTable;

class HospitalDT extends DataTable
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
            ->addColumn('action', function ($hospitals) {
                return '<a href="hospitals/'.$hospitals->id.'"><button><i class="glyphicon glyphicon-eye-open"></i></button></a><a href="hospitals/'.$hospitals->id.'/edit"><button><i class="glyphicon glyphicon-edit"></i></button></a><a href="#"><button class="btn-delete" data-remote="/hospitals/'.$hospitals->id.'"><i class="glyphicon glyphicon-trash"></i></button></a>';
            })
            ->editColumn('wards_count',function($data){
                return "<a href='hospitals/".$data->id."'><span class='badge bg-color-greenLight '>".$data->wards->count()."</span></a>" . " <!--a href='wards?hospital_id=".$data->id."'><button><li class='fa fa-search'></li></button></a--> <a href='wards/create?hospital_id=".$data->id."'><button><li class='fa fa-plus'></li></button></a>";
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
        $hospitals = Hospital::with('wards')->select('*');

        return $this->applyScopes($hospitals);
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
            'hospital_name',
            'address',
            'wards_count',


        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'hospitals';
    }
}
