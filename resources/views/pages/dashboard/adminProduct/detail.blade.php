@extends('layouts.dashboard.main-dashboard', [
    'sbMaster' => true,
    'sbMasterSubMenu' => true,
    'sbList' => 'data.product'
])

@section('main-breadcrumb')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Product</h3>
                    <p class="text-subtitle text-muted">About This Product</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/manage_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">Detail Product</li>
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
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-content">
                            @if ($detail->image_product)
                                <img class="card-img-top img-fluid" src="{{ asset('storage/' . $detail->image_product) }}" 
                                    alt="Card image cap" style="height: 20rem" />
                            @else
                                <img class="card-img-top img-fluid" src="{{ asset('assets/backend/images/samples/default-files.svg') }}" 
                                    alt="Card image cap" style="height: 20rem" />
                            @endif
                            <div class="card-body">
                                <h4>{{ $detail->name_product }}</h4>
                                <p class="card-title">
                                    Category : <span class="text-success font-bold">
                                        {{ $detail->category->name_category }}
                                    </span>
                                </p>
                                <p class="card-title">
                                    Worker : <span class="text-primary font-bold">
                                        {{ $detail->worker->fullname }}
                                    </span>
                                </p>
                                <ul class="mt-0">
                                    <li><h6>Berat : {{ $detail->weight_product / 1000 }} Kg</h6></li>
                                    <li><h6>Harga : @currency($detail->price_product)</h6></li>
                                    <li><h6>Stock : @stock($detail->stock_product) Stock</h6></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <p class="card-text">
                                    {!! $detail->desc_product !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection