@extends('layouts.app')

@section('title', 'Show Instrument')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('kui.index') }}">Instrument</a></li>
        <li class="breadcrumb-item active">Show</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="">

            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Show Instrument <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_ps">No Pernyataan <span class="text-danger">*</span></label>
                                        <input type="number" min="1" class="form-control" name="no_ps" disabled
                                            value="{{ $instrument->no_ps }}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="pernyataan_standar">Pernyataan Standar <span
                                                class="text-danger">*</span></label>
                                        <textarea name="pernyataan_standar" id="pernyataan_standar" rows="3" class="form-control" disabled>{{ old('pernyataan_standar', $instrument->pernyataan_standar) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="penanggung_jawab">Penanggung Jawab <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="penanggung_jawab"
                                            placeholder="Masukan Penanggung Jawab"
                                            value="{{ $instrument->penanggungJawab->name }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no">No Indikator <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="no"
                                            value="{{ $instrument->no }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="indikator">Indikator <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" name="no"
                                            value="{{ $instrument->indikator }}" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="deskripsi"
                                            value="{{ $instrument->deskripsi }}" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="akar_penyebab">Akar Penyebab <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="akar_penyebab"
                                            value="{{ $instrument->akar_penyebab }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="akibat">Akibat <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="akibat"
                                            value="{{ $instrument->akibat }}" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="auditee">Auditee<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="auditee" disabled
                                            value="{{ !is_null($instrument->auditee) ? $instrument->auditeeUser->name : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="{{ !is_null($instrument->auditee) && $is_auditor ? 'd-block' : 'd-none' }}">

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rekomendasi">Rekomendasi <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="rekomendasi"
                                                value="{{ $instrument->rekomendasi }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="tanggapan">Tanggapan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="tanggapan"
                                                value="{{ $instrument->tanggapan }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rencana">Rencana <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="rencana"
                                                value="{{ $instrument->rencana }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_code">Jadwal <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="jadwal"
                                                value="{{ $instrument->jadwal }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_code">Sebutan <span class="text-danger">*</span></label>
                                            <select class="form-control" name="sebutan" id="sebutan">
                                                <option value="" selected>Pilih Sebutan</option>
                                                <option value="positif">Positif</option>
                                                <option value="negatif">Negatif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="link">Link <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="link"
                                                value="{{ $instrument->link }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="status"
                                                value="{{ $instrument->status }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>


@endsection
