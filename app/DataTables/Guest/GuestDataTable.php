<?php

namespace App\DataTables\Guest;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GuestDataTable extends DataTable
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
            ->editColumn('full_name', 'admin.table.full_name')
            ->editColumn('profession', '{{ $profession["name_uz"] ?? "Kiritilmagan"}}')
            ->editColumn('status', 'admin.table.status')
            ->editColumn('action', 'admin.table.action')
            ->addColumn('GuestUserID', '{{ $id }}')
            ->editColumn('email', '{{ $email ?? "Elektron pochta kiritilmagan" }}')
            ->editColumn('phone', '{{ $phone ?? "Telefon pochta kiritilmagan" }}')
            ->addColumn('country_name', '{{ $country["name_uz"] ?? "Davlat ko\'rsatilmagan" }}')
            ->rawColumns(['GuestUserID', 'action', 'full_name', 'status', 'email', 'phone', 'country_name', 'profession']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $query = [];
        $query[] = ['user_type', 5];
        $query[] = ['status', 'active'];
        
        if (isset($this->attributes['country_id']) && $this->attributes['country_id']) {
            $query[] = ['country_id', 1];
        }
        if (isset($this->attributes['country_id']) && !$this->attributes['country_id']) {
            $query[] = ['country_id','!=', 1];
        }
        if (isset($this->attributes['country'])) {
            $query[] = ['country_id', '=', $this->attributes['country']];
        }
        if (isset($this->attributes['profession_id'])) {
            $query[] = ['profession_id', '=', $this->attributes['profession_id']];
        }
        return $model->newQuery()->where($query)->with('country')->with('profession');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('guest-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'initComplete' => "function(){ $('.dataTables_filter').appendTo('#tableSearch'); $('.dataTables_filter').appendTo('.search-input'); }",
                'lengthMenu' => [100, 200, 300, 500, 1000],
                'bFilter' => true,
                'sDom' => "Blfrtip", //fBtlpi
                'ordering' => true,
                'buttons' => [
                    [
                        'extend' => 'excel',
                        'text' => trans("Excel faylda yuklab olish"),
                        'title' => trans("Tadbir mehmonlari ro'yxati"),
                        'exportOptions' =>  [
                            'columns' => ':visible',
                        ]
                    ],
                ],
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
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('first_name')->exportable(false)->printable(false)->searchable(true)->visible(false),
            Column::make('id')->exportable(false)->printable(false)->searchable(true)->visible(false),
            Column::make('last_name')->exportable(false)->printable(false)->searchable(true)->visible(false),
            Column::make('DT_RowIndex')->title('#')->style('white-space: nowrap;')->addClass('text-center')->searchable(false)->sortable(false),
            Column::computed('full_name')->style('white-space: nowrap; text-align: left;')->title(trans("To'liq ismi"))->searchable(false),
            Column::make('email')->title(trans("Elektron pochta"))->searchable(true),
            Column::make('phone')->title(trans("Telefon raqam"))->searchable(true),
            Column::make('profession')->title(trans("Faoliyat turi"))->searchable(false),
            Column::make('country_name')->title(trans("Davlat"))->searchable(false),
            Column::make('created_at')->title(trans("Qo'shilgan vaqti"))->searchable(false),
            Column::computed('status')->title(trans("Holati"))->searchable(false),
            Column::computed('action')
            ->addClass('action-table-data')
            ->width('1')->title(trans('')),
            Column::computed('GuestUserID')
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
        return 'Guest_' . date('YmdHis');
    }
}
