<?php

namespace App\DataTables\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('full_name', 'admin.table.full_name')
            ->editColumn('status', 'admin.table.status')
            ->editColumn('action', 'admin.table.action')
            ->editColumn('user_role', '{{ $role["name"] }}')
            ->addColumn('UserID', '{{ $id }}')
            ->rawColumns(['UserID', 'action', 'user_role', 'full_name', 'status']);
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->with('role')->where([['user_type', 1]]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
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

    public function getColumns(): array
    {
        return [
            Column::make('id')->exportable(false)->printable(false)->searchable(false)->visible(false),
            Column::make('DT_RowIndex')->title('#')->style('white-space: nowrap;')->addClass('text-center')->searchable(false)->sortable(false),
            Column::make('full_name')->title('Foydalanuvchi (F.I.Sh)'),
            Column::make('email')->title('Elektron pochta')->sortable(false),
            Column::make('created_at')->title(trans("Qo'shilgan vaqti"))->searchable(false),
            Column::computed('user_role')->title(trans("Foydalanuvchi turi"))->searchable(false),
            Column::computed('status')->title(trans("Holati"))->searchable(false),
            Column::computed('action')
                ->addClass('action-table-data')
                ->width('1')->title(trans('')),
        ];
    }

    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
