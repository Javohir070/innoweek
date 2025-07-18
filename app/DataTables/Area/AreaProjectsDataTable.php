<?php

namespace App\DataTables\Area;

use App\Models\Projects\Project;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AreaProjectsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('name_data', 'admin.table.name')
            ->editColumn('full_name', 'admin.table.full_name')
            ->editColumn('department_name', '{{ $department["name_uz"] ?? "Kiritilmagan" }}')
            ->editColumn('area_name', 'admin.table.area_name')
            ->editColumn('status', 'admin.table.status')
            ->editColumn('action', 'admin.table.action')
            ->addColumn('AreaProjectID', '{{ $id }}')
            ->rawColumns(['AreaProjectID', 'action', 'name_data', 'department_name', 'full_name', 'area_name', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Project $model): QueryBuilder
    {
        $query = [];
        $query[] = ['status', 'publish'];

        //for authors
        if (isset($this->attributes['department_id'])) {
            $query[] = ['department_id', $this->attributes['department_id']];
        }

        if (isset($this->attributes['area']) && $this->attributes['area']) {
            $query[] = ['area_id', '!=', null];
        }

        if (isset($this->attributes['area']) && !$this->attributes['area']) {
            $query[] = ['area_id', '=', null];
        }

        if (isset($this->attributes['author'])) {
            $query[] = ['department_id', $this->attributes['author']];
        }
        if (count($query) >= 1) {
            return $model->newQuery()->with('author')->with('area')->with('department')->where($query);
        }
        return $model->newQuery()->with('author')->with('area')->with('department');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('areaprojects-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'initComplete' => "function(){ $('.dataTables_filter').appendTo('#tableSearch'); $('.dataTables_filter').appendTo('.search-input'); }",
                'bFilter' => true,
                'sDom' => "fBtlpi",
                //"dom" => 'lBfrtip',
                'ordering' => true,
                // 'buttons' => [
                //     [
                //         'extend' => 'excel',
                //         'text' => trans("words.table.Export to Excel"),
                //         'title' => trans("words.table.Users list"),
                //         'exportOptions' =>  [
                //             'columns' => ':visible',
                //         ]
                //     ],
                //     [
                //         'extend' => 'print',
                //         'text' => trans("words.table.Print Data"),
                //         'title' => trans("words.table.Users list"),
                //         'exportOptions' =>  [
                //             'columns' => ':visible',
                //         ]
                //     ],
                // ],
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
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->exportable(false)->printable(false)->searchable(true)->visible(false),
            Column::make('project_title')->exportable(false)->printable(false)->searchable(true)->visible(false),
            Column::make('DT_RowIndex')->title('#')->style('white-space: nowrap;')->addClass('text-center')->searchable(false)->sortable(false),
            Column::computed('name_data')->style('white-space: nowrap; text-align: left;')->title(trans('Loyiha nomi'))->searchable(false),
            Column::computed('area_name')->title(trans('Ajratilgan maydon'))->searchable(false),
            Column::computed('department_name')->style('white-space: nowrap; text-align: left;')->title(trans('Boshqarma'))->searchable(false),
            Column::computed('full_name')->style('white-space: nowrap; text-align: left;')->title(trans('Tashkilot'))->searchable(false),
            //Column::make('created_at')->title(trans("Qo'shilgan vaqti"))->searchable(false),
            //Column::computed('status')->title(trans("Holati"))->searchable(false),
            Column::computed('action')
                ->addClass('action-table-data')
                ->width('1')->title(trans('Amallar')),
            Column::computed('AreaProjectID')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->visible(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AreaProjects_' . date('YmdHis');
    }
}
