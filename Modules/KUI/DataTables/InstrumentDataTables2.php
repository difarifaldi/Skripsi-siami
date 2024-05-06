<?php

namespace Modules\KUI\DataTables;

use Modules\KUI\Entities\Instrument;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
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
        \Log::info('Trying to access view:', ['view' => 'kui::instruments.partials.actions']);

        return (new EloquentDataTable($query))
            ->addColumn('action', function ($data) {
                return view('kui::instruments.partials.actions', compact('data'));
            })
            ->addColumn('no_ps', function ($data) {
                return $data->no_ps;
            })
            ->addColumn('pernyataan_standar', function ($data) {
                return $data->pernyataan_standar;
            })
            ->addColumn('no', function ($data) {
                return $data->no;
            })
            ->addColumn('indikator', function ($data) {
                return $data->indikator;
            })
            ->addColumn('deskripsi', function ($data) {
                return $data->deskripsi;
            })
            ->addColumn('nilai', function ($data) {
                return $data->nilai;
            })
            ->addColumn('sebutan', function ($data) {
                return $data->sebutan;
            })
            ->addColumn('akar_penyebab', function ($data) {
                return $data->akar_penyebab;
            })
            ->addColumn('akibat', function ($data) {
                return $data->akibat;
            })
            ->addColumn('rekomendasi', function ($data) {
                return $data->rekomendasi;
            })
            ->addColumn('tanggapan', function ($data) {
                return $data->tanggapan;
            })
            ->addColumn('rencana', function ($data) {
                return $data->rencana;
            })
            ->addColumn('jadwal', function ($data) {
                return $data->jadwal;
            })
            ->addColumn('penanggung_jawab', function ($data) {
                return $data->penanggung_jawab;
            })
            ->addColumn('link', function ($data) {
                return $data->link;
            })
            ->addColumn('status', function ($data) {
                return $data->status;
            });
    }

    public function query(Instrument $model)
    {
        $query = $model->newQuery();
        \Log::info($query->toSql()); // Menampilkan SQL query
        return $query;
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
            ->orderBy(16, 'asc')
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

            Column::make('no')
                ->title('No')
                ->addClass('text-center align-middle')
                ->data('no'),

            Column::make('indikator')
                ->title('Indikator')
                ->addClass('text-center align-middle')
                ->data('indikator'),

            Column::make('deskripsi')
                ->title('Deskripsi')
                ->addClass('text-center align-middle')
                ->data('deskripsi'),

            Column::make('nilai')
                ->title('Nilai')
                ->addClass('text-center align-middle')
                ->data('nilai'),

            Column::make('sebutan')
                ->title('Sebutan')
                ->addClass('text-center align-middle')
                ->data('sebutan'),

            Column::make('akar_penyebab')
                ->title('Akar Penyebab')
                ->addClass('text-center align-middle')
                ->data('akar_penyebab'),

            Column::make('akibat')
                ->title('Akibat')
                ->addClass('text-center align-middle')
                ->data('akibat'),

            Column::make('rekomendasi')
                ->title('Rekomendasi')
                ->addClass('text-center align-middle')
                ->data('rekomendasi'),

            Column::make('tanggapan')
                ->title('Tanggapan')
                ->addClass('text-center align-middle')
                ->data('tanggapan'),

            Column::make('rencana')
                ->title('Rencana')
                ->addClass('text-center align-middle')
                ->data('rencana'),

            Column::make('jadwal')
                ->title('Jadwal')
                ->addClass('text-center align-middle')
                ->data('jadwal'),

            Column::make('penanggung_jawab')
                ->title('Penanggung Jawab')
                ->addClass('text-center align-middle')
                ->data('penanggung_jawab'),

            Column::make('link')
                ->title('Link')
                ->addClass('text-center align-middle')
                ->data('link'),

            Column::make('status')
                ->title('Status')
                ->addClass('text-center align-middle')
                ->data('status'),

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
