@extends('layouts.frontend.main')
@section('content')
    <div class="container" style="padding-top: 6.5rem; padding-bottom: 5rem;">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row justify-content-between">
                    <div class="col-xl-3 mt-3">
                        <a href="{{ route('history.list') }}" class="btn btn-sm btn-dark text-decoration-none"><i class="fas fa-fw fa-arrow-left"></i>
                             Back to List
                        </a>
                    </div>
                    <h2 class="text-center my-4">Detail History</h2>
                    <div class="col-xl-8">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <h5 class="card-title text-center my-3">Product List</h5>
                                <ul class="list-group list-group-flush">
                                    @foreach ($keranjang as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <span class="badge bg-primary">#{{ $item->product->uuid }}</span>
                                            <span>{{ $item->product->name_product }}</span>
                                            <span>{{$item->quantity}} Item</span>
                                            <span class="badge bg-success">@currency($item->product->price_product)</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="col-xl-6 my-3">
                                    <h5 class="text-dark">Name : <span>{{ auth()->user()->name }}</span></h5>
                                    <p class="card-text">Province : <span>{{ $checkout->province->name_province }}</span></p>
                                    <p class="card-text">City : <span>{{ $checkout->cities->nama_kab_kota }}</span></p>
                                    <p class="card-text">Address : <span>{{ $checkout->alamat }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <h5 class="card-title text-center my-3">Detail Payment</h5>
                                <p class="card-text">Courier : <span>{{ strtoupper($checkout->courier) }}</span></p>
                                <p class="card-text">Service : <span>{{ $checkout->layanan_ongkir }}</span></p>
                                <p class="card-text">Price Shipping : <span>@currency($checkout->harga_ongkir)</span></p>
                                <p class="card-text">Total Amount : <span>@currency($checkout->total_amount)</span></p>
                                <h5 class="text-dark fw-bold">Total Payment : <span>@currency($checkout->total_amount + $checkout->harga_ongkir)</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection