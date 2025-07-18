<?php

namespace App\DataTables\Area;

use App\Models\Projects\ProjectArea;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectAreaDataTable extends DataTable
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
            ->editColumn('status', 'admin.table.status')
            ->editColumn('action', 'admin.table.action')
            ->addColumn('ProjectAreaID', '{{ $id }}')
            ->rawColumns(['ProjectAreaID', 'action', 'name_data', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProjectArea $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('projectarea-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'initComplete' => "function(){ $('.dataTables_filter').appendTo('#tableSearch'); $('.dataTables_filter').appendTo('.search-input'); }",
                'bFilter' => true,
                'sDom' => "fBtlpi",
                'ordering' => true,
                'language' => [
                    'search' => ' ',
                    'sLengthMenu' => "_MENU_",
                    'searchPlaceholder' => "Izlash...",
                    'info' => "Ma'lumotlar _START_ - _END_ ta _TOTAL_ dan",
                    'paginate' => [
                        'next' => ' <i class=" fa fa-angle-right"></i>',
                        'previous' => '<i class="fa fa-angle-left"></i> ',
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->exportable(false)->printable(false)->searchable(true)->visible(false),
            Column::make('name_uz')->exportable(false)->printable(false)->searchable(true)->visible(false),
            Column::make('DT_RowIndex')->title('#')->style('white-space: nowrap;')->addClass('text-center')->searchable(false)->sortable(false),
            Column::computed('name_data')->style('white-space: nowrap; text-align: left;')->title(trans('Nomi'))->searchable(false),
            Column::make('created_at')->title(trans("Qo'shilgan vaqti"))->searchable(false),
            Column::computed('status')->title(trans("Holati"))->searchable(false),
            Column::computed('action')
                ->addClass('action-table-data')
                ->width('1')->title(trans('')),
            Column::computed('ProjectAreaID')
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
        return 'ProjectArea_' . date('YmdHis');
    }
}
