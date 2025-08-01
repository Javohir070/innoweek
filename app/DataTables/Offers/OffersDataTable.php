<?php

namespace App\DataTables\Offers;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OffersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query));
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Offer $model): QueryBuilder
    {
        return match (auth()->user()?->role?->id){
            10 => $model->newQuery()->where('user_id', auth()->id()),
            default =>$model->newQuery(),
        };
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('offer-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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
            Column::computed('full_name')->style('white-space: nowrap; text-align: left;')->title(trans('F.I.Sh'))->searchable(false),
            Column::make('email')->title(trans("Email"))->searchable(false),
            Column::make('title')->title(trans("Sarlavha"))->searchable(false),
            Column::make('description')->title(trans("Tavsif"))->searchable(false),
            Column::make('created_at')->title(trans("Qo'shilgan vaqti"))->searchable(false)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Offers_' . date('YmdHis');
    }
}
