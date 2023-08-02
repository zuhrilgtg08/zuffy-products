@extends('layouts.dashboard.main-dashboard', [
    'sbMaster' => true,
    'sbMasterSubMenu' => true,
    'sbList' => 'data.review'
])

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/simple-datatables/style.css') }}">
    <style>
        .rate {
            display: inline-block;
            border: 0;
        }
    
        .rate>input {
            display: none;
        }
    
        .rate>label {
            float: right;
        }
    
        .rate>label:before {
            display: inline-block;
            font-size: 2rem;
            font-style: normal;
            font-weight: 900;
            padding: .3rem .2rem;
            margin: 0;
            cursor: pointer;
            font-family: 'Font Awesome\ 5 Free';
            content: "\f005";
        }
    
        .rate .half:before {
            content: "\f089 ";
            position: absolute;
            padding-right: 0;
        }
    
        input:checked~label,
        label:hover,
        label:hover~label {
            color: #deb217;
        }
    
        input:checked+label:hover,
        input:checked~label:hover,
        input:checked~label:hover~label,
        label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
@endsection

@section('main-breadcrumb')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Review Products</h3>
                    <p class="text-subtitle text-muted">Detail Product Reviews</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/manage_dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Review Products</a></li>
                            <li class="breadcrumb-item active">Detail Reviews</li>
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
                            @if ($product->image_product)
                                <img class="card-img-top img-fluid" src="{{ asset('storage/' . $product->image_product) }}"
                                    alt="Card image cap" style="height: 20rem" />
                            @else
                                <img class="card-img-top img-fluid"
                                    src="{{ asset('assets/backend/images/samples/default-files.svg') }}" alt="Card image cap"
                                    style="height: 20rem" />
                            @endif
                            <div class="card-body">
                                <h4>{{ $product->name_product }}</h4>
                                <ul class="mt-0">
                                    <li>
                                        <h6>Berat : {{ $product->weight_product / 1000 }} Kg</h6>
                                    </li>
                                    <li>
                                        <h6>Harga : @currency($product->price_product)</h6>
                                    </li>
                                    <li>
                                        <h6>Stock : @stock($product->stock_product) Stock</h6>
                                    </li>
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
                                    {!! $product->desc_product !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Latest Comments</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg text-center" id="detail-review">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Profile</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            @if ($item->image_profile)
                                            <img src="{{ asset('storage/' . $item->image_profile) }}" class="rounded-circle" width="50"
                                                height="50" alt="img-profile" />
                                            @else
                                            <img src="{{ asset('assets/backend/images/samples/default-files.svg') }}"
                                                class="rounded-circle" width="50" height="50" alt="img-profile" />
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->rating }} <i class="fas fa-fw fa-star text-warning"></i>
                                        </td>
                                        <td>
                                            <p>
                                                {{ $item->coments }}
                                            </p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
            let table = document.querySelector('#detail-review');
            let dataTable = new simpleDatatables.DataTable(table);
    </script>
@endsection