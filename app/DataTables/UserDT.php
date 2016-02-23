<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

class UserDT extends DataTable
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
            ->addColumn('action', function ($user) {
                return '<a href="users/'.$user->id.'"><button><i class="glyphicon glyphicon-eye-open"></i></button></a><a href="users/'.$user->id.'/edit"><button><i class="glyphicon glyphicon-edit"></i></button></a><a href="#"><button class="btn-delete" data-remote="/users/'.$user->id.'"><i class="glyphicon glyphicon-trash"></i></button></a>';
            })
            ->editColumn('role',function($data){
                if($data->roles->count()>0){
                    return $data->roles->first()->name;
                }else{
                    return 'No Roles<br /><a href="users/'.$data->id.'/edit"><button class="btn btn-primary btn-xs">Set Now</button></a>';
                }
            })
            ->editColumn('hospital',function($data){
                if($data->hospital){
                    return $data->hospital->hospital_name;
                }

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
            $users = User::with('roles')->select('*');

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
            'name',
            'email',
            ['data'=>'role','name'=>'role','title'=>'Role','searchable'=>false,'orderable'=>false],
            ['data'=>'hospital','name'=>'hospital','title'=>'Hospital','searchable'=>false,'orderable'=>false],

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
