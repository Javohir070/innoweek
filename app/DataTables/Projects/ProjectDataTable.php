<?php

namespace App\DataTables\Projects;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProjectDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('name_data', 'admin.table.name')
            ->editColumn('full_name', 'admin.table.full_name')
            ->editColumn('department_name', '{{ $department["name_uz"] ?? "Kiritilmagan" }}')
            ->editColumn('status', 'admin.table.status')
            ->editColumn('action', 'admin.table.action')
            ->addColumn('ProjectID', '{{ $id }}')
            ->rawColumns(['ProjectID', 'action', 'name_data', 'full_name', 'status', 'department_name']);
    }

    public function query(Project $model): QueryBuilder
    {
        $query = [];

        //$query[] = ['status', '!=', 'deleted'];
        
        //for authors
        if (isset($this->attributes['department_id'])) {
            $query[] = ['department_id', $this->attributes['department_id']];
        }

        if (isset($this->attributes['cooperation'])) {
            $query[] = ['passport_file', '!=', null];
        }
        if (isset($this->attributes['author'])) {
            $query[] = ['department_id', $this->attributes['author']];
        }
        if (isset($this->attributes['category_id'])) {
            $query[] = ['category_id', $this->attributes['category_id']];
        }
        if (count($query) >= 1) {
            return $model->newQuery()->with('author')->with('department')->where($query);
        }
        return $model->newQuery()->with('author')->with('department');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('project-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->parameters([
                        'initComplete' => "function(){ $('.dataTables_filter').appendTo('#tableSearch'); $('.dataTables_filter').appendTo('.search-input'); }",
                        'bFilter' => true,
                        'sDom' => "fBtlpi",
                        'ordering' => true,
                        'language' => [
                            'search' => '  ',
                            'searchPlaceholder' => trans("Izlash..."),
                            'sLengthMenu' => "_MENU_",
                            'info' => "Ma'lumotlar _START_ - _END_ ta _TOTAL_ dan",
                            'paginate' => [
                                'next' => ' <i class=\"fa fa-angle-right\"></i>',
                                'previous' => '<i class=\"fa fa-angle-left\"></i> ',
                            ],
                        ]
                    ])
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

    public function getColumns(): array
    {
        return [
            Column::make('id')->exportable(false)->printable(false)->searchable(true)->visible(false),
            Column::make('project_title')->exportable(false)->printable(false)->searchable(true)->visible(false),
            Column::make('DT_RowIndex')->title('#')->style('white-space: nowrap;')->addClass('text-center')->searchable(false)->sortable(false),
            Column::computed('name_data')->style('white-space: nowrap; text-align: left;')->title(trans('Loyiha nomi'))->searchable(false),
            Column::computed('full_name')->style('white-space: nowrap; text-align: left;')->title(trans('Tashkilot Nomi'))->searchable(false),
            Column::computed('department_name')->style('white-space: nowrap; text-align: left;')->title(trans('Boshqarma'))->searchable(false),
            //Column::make('created_at')->title(trans("Qo'shilgan vaqti"))->searchable(false),
            Column::computed('status')->title(trans("Holati"))->searchable(false),
            Column::computed('action')
            ->addClass('action-table-data')
            ->width('1')->title(trans('')),
            Column::computed('ProjectID')
            ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->visible(false),
        ];
    }

    protected function filename(): string
    {
        return 'Project_' . date('YmdHis');
    }
}
