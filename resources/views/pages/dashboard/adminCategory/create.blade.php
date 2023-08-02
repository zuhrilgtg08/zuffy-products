@extends('layouts.dashboard.main-dashboard', [
    'sbMaster' => true,
    'sbMasterSubMenu' => true,
    'sbList' => 'data.category'
])

@section('main-breadcrumb')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Create New Category</h3>
                    <p class="text-subtitle text-muted">New Category</p>
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                            <li class="breadcrumb-item active">New Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-dashboard')
    <section class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name-category" class="form-label">Name Category</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-fw fa-fire"></i></span>
                                <input type="text" id="name-category" name="name_category" class="form-control 
                                @error('name_category') is-invalid @enderror" required
                                    value="{{ old('name_category') }}" placeholder="Name Category" />
                                @error('name_category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="slug-category" class="form-label">Slug Category</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-fw fa-water"></i></span>
                                <input type="text" id="slug-category" name="slug" class="form-control 
                                @error('slug') is-invalid @enderror" required
                                    value="{{ old('slug') }}" placeholder="Slug Category" />
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3 col-lg-4 mx-auto">
                            <button type="submit" class="btn btn-primary rounded-pill">
                                Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // slug
        const title = document.querySelector('#name-category');
        const slug = document.querySelector('#slug-category');
        
        title.addEventListener('change', function(){
            fetch('/admin/categories/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>
@endsection