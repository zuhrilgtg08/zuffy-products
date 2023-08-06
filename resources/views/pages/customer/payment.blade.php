@extends('layouts.frontend.main')
@section('content')
    <div class="container" style="padding-top: 6.5rem; padding-bottom: 5rem;">
        <div class="row justify-content-center">
            <h2 class="text-center my-4">Detail Customer & Order</h2>
            @if (session()->has('success'))
                <div class="alert col-lg-8 my-3 alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
             @if (session()->has('fail'))
                <div class="alert col-lg-8 my-3 alert-danger alert-dismissible fade show" role="alert">
                    {{ session('fail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-xl-12 mt-3">
                <table class="table table-striped text-center mb-5">
                    <thead class="bg-dark text-white">
                        <th>Name</th>
                        <th>Item Product</th>
                        <th>Quantity</th>
                        <th>Courier</th>
                        <th>Price Product</th>
                        <th>Price Shipping</th>
                        <th>Total Amount</th>
                    </thead>
                    <tbody>
                        @foreach ($order as $item)
                            <tr>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->product->name_product }}</td>
                                <td>{{ $item->quantity }} Item</td>
                                <td>{{ $item->checkout->courier }}</td>
                                <td>@currency($item->product->price_product)</td>
                                <td>@currency($item->checkout->harga_ongkir)</td>
                                <td>@currency($item->checkout->harga_ongkir + $item->checkout->total_amount)</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-xl-6">
                    <div class="card shadow border-0 mb-5">
                        <div class="card-body">
                            <a href="{{ $payment_link ?? '-'}}" target="_blank" class="card-text">
                                {{ $payment_link ?? '-' }}
                            </a>
                            <p class="card-text">
                                Status Payment : 
                                <span>{{ $payment_status ?? '-' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('checkout.payment.store') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $amount }}" />
                    <button type="submit" class="btn btn-danger rounded-pill">
                        <i class="fas fa-fw fa-wallet"></i> Pay Now
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection