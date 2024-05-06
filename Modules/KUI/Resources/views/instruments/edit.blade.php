@extends('layouts.app')

@section('title', 'Edit Instrument')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('kui.index') }}">Instrument</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('kui.update', $instrument->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Edit Instrument <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_ps">No Pernyataan <span class="text-danger">*</span></label>
                                        <input type="number" min="1" class="form-control" name="no_ps" readonly
                                            required value="{{ $instrument->no_ps }}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="pernyataan_standar">Pernyataan Standar <span
                                                class="text-danger">*</span></label>
                                        <textarea name="pernyataan_standar" id="pernyataan_standar" rows="3" class="form-control" required readonly>{{ old('pernyataan_standar', $instrument->pernyataan_standar) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="penanggung_jawab">Penanggung Jawab <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="penanggung_jawab" required
                                            placeholder="Masukan Penanggung Jawab"
                                            value="{{ $instrument->penanggungJawab->name }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no">No Indikator <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="no" required
                                            value="{{ old('no', $instrument->no ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="indikator">Indikator <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="indikator" required
                                            value="{{ old('indikator', $instrument->indikator ?? '') }}">
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="deskripsi" required
                                            value="{{ old('deskripsi', $instrument->deskripsi ?? '') }}">
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="akar_penyebab">Akar Penyebab <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="akar_penyebab" required
                                            value="{{ old('akar_penyebab', $instrument->akar_penyebab ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="akibat">Akibat <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="akibat" required
                                            value="{{ old('akibat', $instrument->akibat ?? '') }}">
                                    </div>
                                </div>

                            </div>
                            <div class="{{ !is_null($instrument->auditee) && $is_auditor ? 'd-block' : 'd-none' }}">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="auditee">Auditee<span class="text-danger">*</span></label>
                                            <input type="text" class="form  -control" name="auditee" readonly
                                                value="{{ !is_null($instrument->auditee) ? $instrument->auditeeUser->name : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rekomendasi">Rekomendasi <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="rekomendasi"
                                                value="{{ old('rekomendasi', $instrument->rekomendasi ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="tanggapan">Tanggapan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="tanggapan"
                                                value="{{ old('tanggapan', $instrument->tanggapan ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rencana">Rencana <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="rencana"
                                                value="{{ old('rencana', $instrument->rencana ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_code">Jadwal <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="jadwal"
                                                value="{{ old('jadwal', $instrument->jadwal ?? '', now()->format('Y-m-d')) }}">
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
                                                value="{{ old('link', $instrument->link ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="status"
                                                value="{{ old('status', $instrument->status ?? '') }}">
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
