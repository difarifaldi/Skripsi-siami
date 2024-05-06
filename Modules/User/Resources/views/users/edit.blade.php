@extends('layouts.app')

@php
    $prodis = App\Models\Prodi::with('jurusan')->get();

    $selectedJurusan = $user->jurusan->id_jurusan;

@endphp

@section('title', 'Edit User')

@section('third_party_stylesheets')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-lg-12">
                    @include('utils.alerts')
                    <div class="form-group">
                        <button class="btn btn-primary">Update User <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" required value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" required value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ruang_lingkup_audit">Ruang Lingkup Audit <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="ruang_lingkup_audit" required value="{{ $user->ruang_lingkup_audit }}">
                                    </div>
                                </div>
                            </div>

                        <div class="form-group">
                            <label for="jurusan">Jurusan <span class="text-danger">*</span></label>
                            <select class="form-control" name="jurusan" id="jurusan" required onchange="filterProdi()">
                                <option value="" selected disabled>Select Jurusan</option>
                                @foreach(App\Models\Jurusan::all() as $jurusan)
                                    <option {{ $user->jurusan->id_jurusan === $jurusan->id_jurusan ? 'selected' : '' }} value="{{ $jurusan->nama_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Prodi <span class="text-danger">*</span></label>
                            <select class="form-control" name="prodi" id="prodi" required>
                                <option value="" selected disabled>Select Prodi</option>
                                @foreach(App\Models\Prodi::where('id_jurusan', $selectedJurusan)->get() as $prodi)
                                        <option {{ $user->prodi->id_prodi === $prodi->id_prodi ? 'selected' : '' }} value="{{ $prodi->nama_prodi }}">{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenjangProdi">Jenjang Prodi <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenjangProdi" id="jenjangProdi" required>
                                <option value="" selected disabled>Select Jenjang Prodi</option>
                                @foreach(App\Models\JenjangProdi::all() as $jenjangProdi)
                                        <option {{ $user->jenjangProdi->id_jenjang_prodi === $jenjangProdi->id_jenjang_prodi ? 'selected' : '' }} value="{{ $jenjangProdi->nama_jenjang_prodi }}">{{ $jenjangProdi->nama_jenjang_prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="form-group">
                                <label for="role">Role <span class="text-danger">*</span></label>
                                <select class="form-control" name="role" id="role" required>
                                    @foreach(\Spatie\Permission\Models\Role::where('name', '!=', 'Super Admin')->get() as $role)
                                        <option {{ $user->hasRole($role->name) ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="is_active">Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="is_active" id="is_active" required>
                                    <option value="1" {{ $user->is_active == 1 ? 'selected' : ''}}>Active</option>
                                    <option value="2" {{ $user->is_active == 2 ? 'selected' : ''}}>Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">Profile Image <span class="text-danger">*</span></label>
                                <img style="width: 100px;height: 100px;" class="d-block mx-auto img-thumbnail img-fluid rounded-circle mb-2" src="{{ $user->getFirstMediaUrl('avatars') }}" alt="Profile Image">
                                <input id="image" type="file" name="image" data-max-file-size="500KB">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('third_party_scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@push('page_scripts')
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );
        const fileElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(fileElement, {
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        });
        FilePond.setOptions({
            server: {
                url: "{{ route('filepond.upload') }}",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }
        });
    </script>

<script>
    function filterProdi() {
        var jurusan = document.getElementById('jurusan').value;
        var prodiSelect = document.getElementById('prodi');

        // Clear existing options
        prodiSelect.innerHTML = '<option value="" selected disabled>Select Prodi</option>';

        // Filter and add options based on selected jurusan
        @foreach($prodis as $prodi)
            if ('{{ $prodi->jurusan->nama_jurusan }}' == jurusan) {
                var option = document.createElement('option');
                option.value = '{{ $prodi->nama_prodi }}';
                option.text = '{{ $prodi->nama_prodi }}';
                prodiSelect.appendChild(option);
            }
        @endforeach
    }
    </script>
@endpush


