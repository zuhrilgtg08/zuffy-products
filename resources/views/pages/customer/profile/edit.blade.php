@extends('layouts.frontend.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/flatpicker/flatpicker.min.css') }}">
@endsection

@section('content')
    <div class="container" style="padding-top: 7.5rem; padding-bottom: 10rem;">
        <div class="row justify-content-center">
            @if (session()->has('success'))
                <div class="col-xl-8 my-3 text-center">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            
            @if (session()->has('fail'))
                <div class="col-xl-8 my-3 text-center">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('fail') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="card border-0 shadow my-3">
                <div class="card-body">
                    <h2 class="text-center h2-heading mt-3">Edit Your Data Profile</h2>
                    <form action="{{ route('customer.profile.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mt-3">
                            <div class="col-xl-12">
                                <div class="row justify-content-center">
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Your Name</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-fw fa-tags"></i></span>
                                                <input type="text" id="name" name="name" class="form-control 
                                                    @error('name') is-invalid @enderror" required value="{{ old('name', $data->name) }}"
                                                        placeholder="Your Name" />
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-fw fa-sign"></i></span>
                                                <input type="text" id="username" name="username" class="form-control 
                                                    @error('username') is-invalid @enderror" required
                                                        value="{{ old('username', $data->username) }}" placeholder="Your Username" />
                                                @error('username')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-fw fa-envelope"></i></span>
                                                <input type="email" id="email" name="email" class="form-control 
                                                    @error('email') is-invalid @enderror" required value="{{ old('email', $data->email) }}"
                                                        placeholder="Your Email" />
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="row justify-content-center">
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="tgl-lahir" class="form-label">Your Date</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-fw fa-calendar"></i></span>
                                                <input type="date" id="tgl-lahir" name="tgl_lahir" class="form-control 
                                                    @error('tgl_lahir') is-invalid @enderror flatpickr-no-config" required
                                                        value="{{ old('tgl_lahir', $data->tgl_lahir) }}" placeholder="Your Date" />
                                                @error('tgl_lahir')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="job" class="form-label">Your Job</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-fw fa-hand-holding"></i></span>
                                                <input type="text" id="job" name="job" class="form-control 
                                                    @error('job') is-invalid @enderror" required value="{{ old('job', $data->job) }}"
                                                        placeholder="Your Job" />
                                                @error('job')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="agama" class="form-label">Religion</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-fw fa-republican"></i></span>
                                                <select name="agama" id="agama" class="form-select 
                                                    @error('agama') is-invalid @enderror" required>
                                                        <option selected disabled>Choose Religion</option>
                                                        <option value="islam" {{ $data->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                                                        <option value="katolik" {{ $data->agama == 'katolik' ? 'selected' : '' }}>Katolik</option>
                                                        <option value="kristen" {{ $data->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                                                        <option value="budha" {{ $data->agama == 'budha' ? 'selected' : '' }}>Budha</option>
                                                        <option value="hindu" {{ $data->agama == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                                </select>
                                                @error('agama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Your Phone</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="fas fa-fw fa-phone"></i></span>
                                                <input type="text" id="phone" name="phone" class="form-control 
                                                    @error('phone') is-invalid @enderror" required value="{{ old('phone', $data->phone) }}"
                                                        min="12" placeholder="Your Phone" />
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 mt-3">
                                <div class="mb-3">
                                    <label for="image-profile" class="form-label">Image Profile</label>
                                    <input type="hidden" name="oldImage" value="{{ $data->image_profile }}">
                                    @if ($data->image_profile)
                                        <img src="{{ asset('storage/' . $data->image_profile) }}" class="rounded-circle gambar-preview my-3" 
                                            width="250" height="250" alt="img-profile"/>
                                    @else
                                        <img src="{{ asset('assets/frontend/images/profile.svg') }}" 
                                            class="rounded-circle gambar-preview my-3" 
                                                width="250" height="250" alt="img-profile"/>
                                    @endif
                                    <input type="file" name="image_profile" id="image-profile"
                                        class="form-control @error('image_profile') is-invalid @enderror" value="{{ old('image_profile') }}"
                                            onchange="previewGambar()" />
                                    @error('image_profile')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-8 mt-3">
                                <div class="mb-3">
                                    <label for="about-only" class="form-label">Write About You</label>
                                    <div id="snow-editor" style="min-height: 150px">{!! $data->about_only !!}</div>
                                    <input type="hidden" name="about_only" id="about-only" class="@error('about_only') is-invalid @enderror"
                                        value="{{ old('about_only', $data->about_only) }}" required />
                                    @error('about_only')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn-solid-sm">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-5">
                <div class="card border-0 shadow my-5">
                    <h4 class="text-center card-header">Change Your Password Acount</h4>
                    <div class="card-body">
                        <form action="{{ route('customer.profile.pwdChange', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="current" class="form-label">Current Password</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-fw fa-pen"></i></span>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                        required name="current_password" id="current" placeholder="Current Password..." />
                                    @error('current_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="create" class="form-label">Create New Password</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-fw fa-reply"></i></span>
                                    <input type="password" class="form-control @error('create_password') is-invalid @enderror"
                                        required name="create_password" id="create" placeholder="New Password..." />
                                    @error('create_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="confirm" class="form-label">Confirm Password</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-fw fa-check-circle"></i></span>
                                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                                        required name="confirm_password" id="confirm" placeholder="Confirm Password..." />
                                    @error('confirm_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="my-3 text-center">
                                <button type="submit" class="btn-solid-sm">
                                    Confirm Change
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="card border-0 shadow my-5">
                    <h4 class="text-center card-header">Set Your Address Data</h4>
                    <div class="card-body">
                        <form action="{{ route('customer.alamat.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $data->id }}" />
                            <div class="mb-3">
                                <label for="provinsi_id" class="form-label">Choose Provinces</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-fw fa-mountain"></i></span>
                                    <select class="form-select" required name="provinsi_id" id="prvinsi_id">
                                        <option disabled selected>Choose Provinces</option>
                                        @foreach ($provinsi as $item)
                                            @if ($dataAlamat != null)
                                                <option value="{{ $item->id }}"
                                                    {{ ($dataAlamat->provinsi_id == $item->id)? 'selected' : '' }}>{{ $item->name_province }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name_province }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('provinsi_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="kota_id" class="form-label">Choose Cities</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-fw fa-city"></i></span>
                                    <select class="form-select" required name="kota_id" id="kota_id">
                                        <option>Choose City</option>
                                        {{-- @foreach ($kota as $data)
                                            @if ($dataAlamat != null)
                                                <option value="{{ $data->id }}" {{ ($dataAlamat->kota_id == $data->id) ? 'selected' : '' }}>{{ $dataAlamat->city->nama_kab_kota }}</option>
                                            @endif
                                        @endforeach --}}
                                    </select>
                                    @error('kota_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea name="keterangan_alamat" id="ket-alamat" 
                                placeholder="Details Your Address"
                                class="form-control mt-4 @error('keterangan_alamat') is-invalid @enderror">{{ ($dataAlamat != null) ? $dataAlamat->keterangan_alamat : '' }}</textarea>
                                @error('keterangan_alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="my-3 text-center">
                                <button type="submit" class="btn-solid-sm">
                                    Save Change
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/flatpicker/flatpicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select[name="provinsi_id"]').on('change', function() {
                let provinceId = $(this).val();
                if(provinceId) {
                    $.ajax({
                        type: "GET",
                        url: "/data/provinsi/" + provinceId,
                        dataType: "json",
                        success: function (response) {
                            $('select[name="kota_id"]').empty();
                            $.each(response, function(key, value) {
                                $('select[name="kota_id"]').append(
                                    '<option value="'+ value.id +'">' + value.nama_kab_kota + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="kota_id"]').empty();
                }
            });
        });
    </script>
    <script>
        let snowEditor = new Quill('#snow-editor', {
            theme: 'snow'
        });

        snowEditor.on('text-change', function() {
            document.querySelector("input[name='about_only']").value = snowEditor.root.innerHTML;
        });

        function previewGambar() {
            const inputImage = document.querySelector('#image-profile');
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
    </script>
@endsection