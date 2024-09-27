<?php

namespace App\DataTables;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($row) {
            return '<span class="">
            <a href="'. route('projects.edit', $row->id).'"  data-toggle="tooltip" data-html="true"  data-placement="top" title="Edit" class="mr-2" ><i class="fa fa-edit"></i></a>
            <a href="#"  data-toggle="tooltip" data-html="true"  data-placement="top" title="Delete"   data-delete="'.route('projects.destroy',['project'=>$row->id]).'"  data-delete-trigger><i class="fa fa-trash"></i></a>
        </span>';
          })
          ->addColumn('status', function ($row){

             $status = '';
             if($row->status == 'active'){
                $status = '<span class="label label-success">Actice</span>';
             }elseif($row->status == 'inactive'){
                $status = '<span class="label label-danger">Inactive</span>';

             }else{
                $status = '<span class="label label-warning">Hold</span>';

             }
             return $status;
          })
          ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Project $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('data-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
           
            // Column::make('id'),
            Column::make('name'),
            // Column::make('created_at'),
            Column::make('status'),
            Column::make('action'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Projects_' . date('YmdHis');
    }
}
