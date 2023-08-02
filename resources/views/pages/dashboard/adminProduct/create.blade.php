@extends('layouts.dashboard.main-dashboard', [
    'sbMaster' => true,
    'sbMasterSubMenu' => true,
    'sbList' => 'data.product'
])

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/quill/quill.snow.css') }}">
@endsection

@section('main-breadcrumb')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>New Product</h3>
                    <p class="text-subtitle text-muted">Add New Product</p>
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">New Product</li>
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
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name-product" class="form-label">Nama Barang</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-box"></i></span>
                                        <input type="text" id="name-product" name="name_product" class="form-control 
                                             @error('name_product') is-invalid @enderror" required value="{{ old('name_product') }}"
                                            placeholder="Name Product" />
                                        @error('name_product')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="weight-product" class="form-label">Berat Barang</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-weight-hanging"></i></span>
                                        <input type="number" id="weight-product" name="weight_product" class="form-control 
                                            @error('weight_product') is-invalid @enderror" required value="{{ old('weight_product') }}"
                                            min="1"
                                            placeholder="Weight Product" />
                                        @error('weight_product')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="stock-product" class="form-label">Stok Barang</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-cubes"></i></span>
                                        <input type="number" id="stock-product" name="stock_product" class="form-control 
                                            @error('stock_product') is-invalid @enderror" required value="{{ old('stock_product') }}"
                                            placeholder="Stock Product" 
                                            min="1" />
                                        @error('stock_product')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="category-list" class="form-label">Category</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-stream"></i></span>
                                        <select name="category_id" id="category-list" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option disabled selected>Choose Category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name_category }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="worker-list" class="form-label">Worker</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-fw fa-user-ninja"></i></span>
                                        <select name="worker_id" id="worker-list" class="form-select @error('worker_id') is-invalid @enderror"
                                            required>
                                            <option disabled selected>Choose Worker</option>
                                            @foreach ($workers as $item)
                                                <option value="{{ $item->id }}">{{ $item->fullname }}</option>
                                            @endforeach
                                        </select>
                                        @error('worker_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="price-product" class="form-label">Harga Barang</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" id="price-product" name="price_product" class="form-control 
                                            @error('price_product') is-invalid @enderror" required min="1"
                                            value="{{ old('price_product') }}" placeholder="Price Product" />
                                        @error('price_product')
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
                                <label for="image-product" class="form-label">Gambar Barang</label>
                                <img class="img-fluid gambar-preview my-3" />
                                <input type="file" name="image_product" id="image-product" 
                                    class="form-control @error('image_product') is-invalid @enderror" 
                                    value="{{ old('image_product') }}" onchange="previewGambar()"/>
                                @error('image_product')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="desc-product" class="form-label">Deskripsi Barang</label>
                            <div id="snow-editor" style="min-height: 150px"></div>
                            <input type="hidden" name="desc_product" id="desc-product"
                                class="@error('desc_product') is-invalid @enderror"
                                value="{{ old('desc_product') }}" required/>
                            @error('desc_product')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-3 col-lg-2 float-end">
                            <button type="submit" class="btn btn-primary rounded-pill">
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/quill/quill.min.js') }}"></script>
    <script>
        let snowEditor = new Quill('#snow-editor', {
            theme: 'snow'
        });

        snowEditor.on('text-change', function() {
            document.querySelector("input[name='desc_product']").value = snowEditor.root.innerHTML;
        });

        function previewGambar() {
            const inputImage = document.querySelector('#image-product');
            const imagePreview = document.querySelector('.gambar-preview');
            imagePreview.style.display = 'block';
            
            const oFReader = new FileReader();
            oFReader.readAsDataURL(inputImage.files[0]);
            
            oFReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection