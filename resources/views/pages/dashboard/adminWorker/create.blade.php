@extends('layouts.dashboard.main-dashboard', [
    'sbMaster' => true,
    'sbMasterSubMenu' => true,
    'sbList' => 'data.worker'
])

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/flatpicker/flatpicker.min.css') }}">
@endsection

@section('main-breadcrumb')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Add New Worker</h3>
                    <p class="text-subtitle text-muted">New Worker</p>
                    @if (session()->has('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('fail') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/manage_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.workers.index') }}">Workers</a></li>
                            <li class="breadcrumb-item active">New Worker</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-dashboard')
    <section class="row">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body">
                    <form action="{{ route('admin.workers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Nama Lengkap</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-file-signature"></i></span>
                                        <input type="text" id="fullname" name="fullname" class="form-control 
                                             @error('fullname') is-invalid @enderror" required value="{{ old('fullname') }}"
                                            placeholder="Your Fullname" />
                                        @error('fullname')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat-worker" class="form-label">Alamat Worker</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-home"></i></span>
                                        <input type="text" id="alamat-worker" name="w_ket_alamat" class="form-control 
                                         @error('w_ket_alamat') is-invalid @enderror" required value="{{ old('w_ket_alamat') }}"
                                            placeholder="Keterangan Alamat" />
                                        @error('w_ket_alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                               <div class="mb-3">
                                    <label for="username" class="form-label">Username Worker</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-hashtag"></i></span>
                                        <input type="text" id="username" name="username" class="form-control 
                                        @error('username') is-invalid @enderror" required
                                            value="{{ old('username') }}" placeholder="Your Username" />
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="provinces-list" class="form-label">Provinsi</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-mountain"></i></span>
                                        <select name="w_provinsi_id" id="provinces-list" class="form-select @error('w_provinsi_id') is-invalid @enderror" required>
                                            <option disabled selected>Choose Provinces</option>
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id }}">{{ $item->name_province }}</option>
                                            @endforeach
                                        </select>
                                        @error('w_provinsi_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="kota-list" class="form-label">Kota/Kabupaten</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-city"></i></span>
                                        <select name="w_kota_id" id="kota-list" class="form-select @error('w_kota_id') is-invalid @enderror"
                                            required>
                                            <option>Choose City</option>
                                        </select>
                                        @error('w_kota_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl-lahir" class="form-label">Tanggal Lahir</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-calendar"></i></span>
                                        <input type="date" id="tgl-lahir" name="tgl_lahir" class="form-control 
                                            @error('tgl_lahir') is-invalid @enderror flatpickr-no-config" required 
                                                value="{{ old('tgl_lahir') }}"
                                                    placeholder="Tanggal Lahir worker" />
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 my-2">
                            <div class="mb-3">
                                <label for="image-profile-worker" class="form-label">Gambar Profile</label>
                                <img class="img-fluid gambar-preview my-3" />
                                <input type="file" name="image_profile_worker" id="image-profile-worker" 
                                    class="form-control @error('image_profile_worker') is-invalid @enderror" 
                                    value="{{ old('image_profile_worker') }}" onchange="previewGambar()"/>
                                @error('image_profile_worker')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="bio-worker" class="form-label">Tentang Worker</label>
                            <div id="snow-editor" style="min-height: 150px"></div>
                            <input type="hidden" name="bio_worker" id="bio-worker"
                                class="@error('bio_worker') is-invalid @enderror"
                                value="{{ old('bio_worker') }}" required/>
                            @error('bio_worker')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-3 col-lg-2 float-end">
                            <button type="submit" class="btn btn-primary rounded-pill">
                                Save Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/flatpicker/flatpicker.min.js') }}"></script>
    <script>
        let snowEditor = new Quill('#snow-editor', {
            theme: 'snow'
        });

        snowEditor.on('text-change', function() {
            document.querySelector("input[name='bio_worker']").value = snowEditor.root.innerHTML;
        });

        function previewGambar() {
            const inputImage = document.querySelector('#image-profile-worker');
            const imagePreview = document.querySelector('.gambar-preview');
            imagePreview.style.display = 'block';
            
            const oFReader = new FileReader();
            oFReader.readAsDataURL(inputImage.files[0]);
            
            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }

        flatpickr('.flatpickr-no-config', {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        })

        $(document).ready(function () {
            $('select[name="w_provinsi_id"]').on('change', function() {
                let provinceId = $(this).val();
                if(provinceId) {
                    $.ajax({
                        type: "GET",
                        url: "/admin/workers/province/" + provinceId,
                        dataType: "json",
                        success: function (response) {
                            $('select[name="w_kota_id"]').empty();
                            $.each(response, function(key, value) {
                                $('select[name="w_kota_id"]').append(
                                    '<option value="'+ value.id +'">' + value.nama_kab_kota + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="w_kota_id"]').empty();
                }
            });
        });
    </script>
@endsection