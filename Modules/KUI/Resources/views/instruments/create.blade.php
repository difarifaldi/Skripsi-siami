@extends('layouts.app')

@section('title', 'Buat Instrument')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('kui.index') }}">Instrument</a></li>
        <li class="breadcrumb-item active">Add</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form id="instrument-form" action="{{ route('kui.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Buat Instrumen <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="no_ps">No Pernyataan <span class="text-danger">*</span></label>
                                        <input type="number" min="1" class="form-control" name="no_ps" required
                                            placeholder="Nomor Pernyataan Standar" value="{{ old('no_ps') }}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="pernyataan_standar">Pernyataan Standar <span
                                                class="text-danger">*</span></label>
                                        <textarea name="pernyataan_standar" id="pernyataan_standar" rows="3 " class="form-control" required
                                            placeholder="Masukan Pernyataan Standar" value="{{ old('pernyataan_standar') }}"></textarea>
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
