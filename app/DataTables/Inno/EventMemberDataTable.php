<?php

namespace App\DataTables\Inno;

use App\Models\EventMember;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EventMemberDataTable extends DataTable
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
            ->editColumn('event_date', '{{ $event["date"] }}')
            ->editColumn('phone', '{{ $user["phone"] ?? "Telefon raqam kiritilmagan" }}')
            ->editColumn('email', '{{ $user["email"] ?? "Elektron pochta kiritilmagan" }}')
            ->addColumn('InnoEventID', '{{ $id }}')
            ->rawColumns(['InnoEventID', 'action', 'name_data', 'full_name', 'event_date', 'phone', 'email']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(EventMember $model): QueryBuilder
    {

        $query = [];
        $query[] = ['id', '!=', null];

        //for event
        if (isset($this->attributes['event_id'])) {
            $query[] = ['event_id', $this->attributes['event_id']];
        }
        return $model->with('event')->with('user')->where($query)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('eventmember-table')
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
            Column::make('id')->exportable(false)->printable(false)->searchable(true)->visible(false),
            //Column::make('title_uz')->exportable(false)->printable(false)->searchable(true)->visible(false),
            //Column::make('title_en')->exportable(false)->printable(false)->searchable(true)->visible(false),
            Column::make('DT_RowIndex')->title('#')->style('white-space: nowrap;')->addClass('text-center')->searchable(false)->sortable(false),
            Column::computed('name_data')->style('white-space: nowrap; text-align: left;')->title(trans('Tadbir nomi'))->searchable(false),
            Column::computed('full_name')->style('white-space: nowrap; text-align: left;')->title(trans('Mehmon (F.I.Sh)'))->searchable(false),
            Column::make('event_date')->title(trans("Tadbir kuni"))->searchable(false),
            Column::make('phone')->title(trans("Telefon raqam"))->searchable(false),
            Column::make('email')->title(trans("Elektron pochta"))->searchable(false),

            Column::computed('InnoEventID')
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
        return 'EventMember_' . date('YmdHis');
    }
}
