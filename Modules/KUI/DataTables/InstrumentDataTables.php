<?php

namespace Modules\KUI\DataTables;

use Modules\KUI\Entities\Instrument;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


class InstrumentDataTables extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {


        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('kui::instruments.partials.actions', compact('data'));
            })
            ->addColumn('no_ps', function ($data) {
                return $data->no_ps;
            })
            ->addColumn('pernyataan_standar', function ($data) {
                return $data->pernyataan_standar;
            })
            ->addColumn('penanggung_jawab', function ($data) {
                if (!is_null($data->penanggung_jawab)) {
                    return $data->penanggungJawab->name;
                } else {
                    return '-';
                }
            });
    }



    public function query(Instrument $model)
    {

        if (Auth::user()->roles[0]->id == 5) {
            return $model->newQuery()
                ->with([
                    'penanggungJawab',
                    'auditeeUser',
                    'auditorUser',
                ]);
        } else {
            if (Auth::user()->roles[0]->id == 4  || Auth::user()->roles[0]->id == 2) {
                return $model->newQuery()
                    ->with([
                        'penanggungJawab',
                        'auditeeUser',
                        'auditorUser',
                    ])
                    ->whereNotNull('auditee');
            }
        }
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {

        return $this->builder()
            ->setTableId('instruments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                            'tr' .
                            <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(3, 'asc')
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> Reload')
            );
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {

        return [
            Column::make('no_ps')
                ->title('No PS')
                ->addClass('text-center align-middle')
                ->data('no_ps'),

            Column::make('pernyataan_standar')
                ->title('Pernyataan Standar')
                ->addClass('text-center align-middle')
                ->data('pernyataan_standar'),

            Column::make('penanggung_jawab')
                ->title('Penanggung Jawab')
                ->addClass('text-center align-middle')
                ->data('penanggung_jawab'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Instrument_' . date('YmdHis');
    }
}
