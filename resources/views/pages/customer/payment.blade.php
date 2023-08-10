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
                <div class="row justify-content-center">
                    <div class="col-xl-7">
                        <table class="table table-striped text-center mb-5">
                            <thead class="bg-dark text-white">
                                <th>Item Product</th>
                                <th>Quantity</th>
                                <th>Price Product</th>
                            </thead>
                            <tbody>
                                @foreach ($order as $item)
                                    <tr>
                                        <td>{{ $item->product->name_product }}</td>
                                        <td>{{ $item->quantity }} Item</td>
                                        <td>@currency($item->product->price_product)</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xl-5">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Name
                                        <span>{{ $name_user ?? auth()->user()->name }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Email
                                        <span>{{ $email_user ?? auth()->user()->email }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Courier
                                        <span>{{ strtoupper($courier) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Price Shipping
                                        <span>@currency($price_shipping)</span>
                                    </li>
                                </ul>
                                <p class="card-text">
                                    Total payment with Shipping :
                                    <span>@currency($amount)</span>
                                </p>
                                <p class="card-text">
                                    <span class="badge bg-primary">
                                        <a href="{{ $payment_link ?? '-'}}" target="_blank" class="text-white">
                                            {{ $payment_link ?? '-' }}
                                        </a>
                                    </span>
                                </p>
                                <p class="card-text">
                                    Status Payment :
                                    <span class="badge bg-success">{{ $payment_status ?? '-' }}</span>
                                </p>

                                <form action="{{ route('checkout.payment.store') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="amount" value="{{ $amount }}" />
                                    <button type="submit" class="{{ ($payment_status == 'PAID') ? 'd-none' : '' }} btn btn-danger rounded-pill btn-sm w-25">
                                        <i class="fas fa-fw fa-wallet"></i> Pay Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection